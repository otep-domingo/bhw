<?php

/**
 * reports.php
 * REST API for BHW Accomplishment Reports
 *
 * Routing (via query string or .htaccess rewrite):
 *   GET    /api/reports           → list all
 *   GET    /api/reports/{id}      → get one
 *   POST   /api/reports           → create
 *   PUT    /api/reports/{id}      → update
 *   DELETE /api/reports/{id}      → delete
 *
 * Expects a mysqli instance from config/db.php:
 *   <?php
 *   $db = new mysqli('localhost', 'user', 'password', 'dbname');
 *   $db->set_charset('utf8mb4');
 *   if ($db->connect_errno) die(json_encode(['error' => 'DB connection failed.']));
 *   return $db;
 */

declare(strict_types=1);

header('Content-Type: application/json');

// ── DB connection ─────────────────────────────────────────────────────────────
/** @var mysqli $db */
//$db = require __DIR__ . '/../config/db.php';
require '../model/connection.php';
$db = $connection;
// ── Constants ─────────────────────────────────────────────────────────────────
const MONTHS = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];

// ── Router ────────────────────────────────────────────────────────────────────
$method = $_SERVER['REQUEST_METHOD'];

$path     = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts    = explode('/', trim($path, '/'));
$reportId = isset($parts[2]) && $parts[2] !== '' ? (int) $parts[2] : null;

try {
    switch ($method) {
        case 'GET':
            $reportId === null ? listReports($db) : getReport($db, $reportId);
            break;
        case 'POST':
            createReport($db);
            break;
        case 'PUT':
            updateReport($db, $reportId);
            break;
        case 'DELETE':
            deleteReport($db, $reportId);
            break;
        default:
            jsonError('Method not allowed.', 405);
            break;
    };
} catch (Throwable $e) {
    error_log('Unhandled error: ' . $e->getMessage());
    jsonError('Internal server error.', 500);
}

// ══════════════════════════════════════════════════════════════════════════════
// HELPERS
// ══════════════════════════════════════════════════════════════════════════════

function jsonResponse(mixed $data, int $status = 200): never
{
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function jsonError(string $message, int $status = 400): never
{
    jsonResponse(['error' => $message], $status);
}

/** Validate report header fields. Returns error string or null. */
function validateHeader(array $h): ?string
{
    $year     = $h['year']    ?? null;
    $bhwName  = trim($h['bhw_name']  ?? '');
    $barangay = trim($h['barangay']  ?? '');
    $area     = trim($h['area']      ?? '');

    if ($year === null || !is_numeric($year) || (int)$year < 2000 || (int)$year > 2100) {
        return 'A valid year (2000-2100) is required.___' . json_encode($h);
    }
    if ($bhwName  === '') return 'BHW name is required.';
    if ($barangay === '') return 'Barangay is required.';
    if ($area     === '') return 'Area is required.';
    return null;
}

/**
 * Execute a prepared statement and return it.
 * Throws RuntimeException on prepare/bind/execute failure.
 */
function mqExec(mysqli $db, string $sql, string $types, array $values): mysqli_stmt
{
    $stmt = $db->prepare($sql);
    if (!$stmt) throw new RuntimeException('Prepare failed: ' . $db->error);

    if ($types !== '') {
        if (!$stmt->bind_param($types, ...$values)) {
            throw new RuntimeException('Bind failed: ' . $stmt->error);
        }
    }

    if (!$stmt->execute()) {
        throw new RuntimeException('Execute failed: ' . $stmt->error);
    }

    return $stmt;
}

/**
 * Upsert accomplishment_data rows.
 * Deletes existing rows for the report, then bulk-inserts new ones.
 */
function upsertAccomplishments(mysqli $db, int $reportId, mixed $tableValues): void
{
    mqExec($db, 'DELETE FROM accomplishment_data WHERE report_id = ?', 'i', [$reportId]);

    if (empty($tableValues) || !is_array($tableValues)) return;

    $placeholders = [];
    $types        = '';
    $params       = [];

    foreach ($tableValues as $rowKey => $monthData) {
        if (!is_array($monthData)) continue;

        $vals = array_map(function (string $m) use ($monthData): int {
            $v = isset($monthData[$m]) ? (int) $monthData[$m] : 0;
            return $v < 0 ? 0 : $v;
        }, MONTHS);

        $rowTotal = array_sum($vals);

        // report_id (i), row_key (s), 12 months (iiiiiiiiiiii), row_total (i) = 15 params
        $placeholders[] = '(?, ?, ' . implode(', ', array_fill(0, 12, '?')) . ', ?)';
        $types .= 'is' . str_repeat('i', 12) . 'i';
        //array_push($params, $reportId, $rowKey, ...$vals, $rowTotal);
        $params = array_merge($params, [$reportId, $rowKey], $vals, [$rowTotal]);
    }

    if (empty($placeholders)) return;

    $sql = 'INSERT INTO accomplishment_data
                (report_id, row_key,
                 jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, `dec`,
                 row_total)
            VALUES ' . implode(', ', $placeholders);

    mqExec($db, $sql, $types, $params);
}

/** Upsert family_planning_methods row. */
function upsertFamilyPlanning(mysqli $db, int $reportId, mixed $fp): void
{
    if (empty($fp) || !is_array($fp)) return;
    mqExec($db, 'DELETE FROM family_planning_methods WHERE report_id = ?', 'i', [$reportId]);
    $bool = fn(mixed $v): int => empty($v) ? 0 : 1;
    $sql = 'INSERT INTO family_planning_methods
             (report_id, fp_pills, fp_injectables, fp_btl, fp_vasectomy,
              fp_implant, fp_condom, fp_cm, fp_bbt, fp_stm, fp_sdm)
         VALUES (?,?,?,?,?,?,?,?,?,?,?)';
    mqExec(
        $db,
        $sql,
        'iiiiiiiiiii',
        [
            $reportId,
            $bool($fp['pills']       ?? null),
            $bool($fp['injectables'] ?? null),
            $bool($fp['btl']         ?? null),
            $bool($fp['vasectomy']   ?? null),
            $bool($fp['implant']     ?? null),
            $bool($fp['condom']      ?? null),
            $bool($fp['cm']          ?? null),
            $bool($fp['bbt']         ?? null),
            $bool($fp['stm']         ?? null),
            $bool($fp['sdm']         ?? null),
        ]
    );
}

// ══════════════════════════════════════════════════════════════════════════════
// ROUTE HANDLERS
// ══════════════════════════════════════════════════════════════════════════════

/** GET /api/reports */
function listReports(mysqli $db): never
{
    try {
        $result = $db->query(
            'SELECT id, year, bhw_name, barangay, area, updated_at
             FROM reports ORDER BY year DESC, bhw_name ASC'
        );
        if (!$result) throw new RuntimeException($db->error);

        jsonResponse($result->fetch_all(MYSQLI_ASSOC));
    } catch (Throwable $e) {
        error_log('List reports error: ' . $e->getMessage());
        jsonError('Failed to fetch reports.', 500);
    }
}

/** GET /api/reports/{id} */
function getReport(mysqli $db, int $reportId): never
{
    try {
        $stmt   = mqExec($db, 'SELECT * FROM reports WHERE id = ?', 'i', [$reportId]);
        $result = $stmt->get_result();
        $report = $result->fetch_assoc();
        $stmt->close();

        if (!$report) jsonError('Report not found. id: ' . $reportId, 404);

        // Accomplishment data
        $stmt   = mqExec(
            $db,
            'SELECT row_key, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, `dec`
             FROM accomplishment_data WHERE report_id = ?',
            'i',
            [$reportId]
        );
        $result = $stmt->get_result();

        $tableValues = [];
        while ($row = $result->fetch_assoc()) {
            $key = $row['row_key'];
            $tableValues[$key] = [];
            foreach (MONTHS as $m) {
                $tableValues[$key][$m] = $row[$m];
            }
        }
        $stmt->close();

        // Family planning
        $stmt   = mqExec($db, 'SELECT * FROM family_planning_methods WHERE report_id = ?', 'i', [$reportId]);
        $result = $stmt->get_result();
        $fp     = $result->fetch_assoc() ?: [];
        $stmt->close();

        jsonResponse([
            'id'     => $report['id'],
            'header' => [
                'year'     => $report['year'],
                'bhw_name' => $report['bhw_name'],
                'barangay' => $report['barangay'],
                'area'     => $report['area'],
            ],
            'tableValues'    => $tableValues,
            'familyPlanning' => [
                'fp_pills'       => !empty($fp['fp_pills']),
                'fp_injectables' => !empty($fp['fp_injectables']),
                'fp_btl'         => !empty($fp['fp_btl']),
                'fp_vasectomy'   => !empty($fp['fp_vasectomy']),
                'fp_implant'     => !empty($fp['fp_implant']),
                'fp_condom'      => !empty($fp['fp_condom']),
                'fp_cm'          => !empty($fp['fp_cm']),
                'fp_bbt'         => !empty($fp['fp_bbt']),
                'fp_stm'         => !empty($fp['fp_stm']),
                'fp_sdm'         => !empty($fp['fp_sdm']),
            ],
        ]);
    } catch (Throwable $e) {
        error_log('Get report error: ' . $e->getMessage());
        jsonError('Failed to fetch report.', 500);
    }
}

/** POST /api/reports */
function createReport(mysqli $db): never
{
    $body           = json_decode(file_get_contents('php://input'), true) ?? [];
    $header         = $body['header']         ?? [];
    $tableValues    = $body['tableValues']    ?? [];
    $familyPlanning = $body['familyPlanning'] ?? [];

    $ve = validateHeader($header);
    if ($ve) jsonError($ve, 400);

    $db->begin_transaction();
    try {
        // Duplicate check
        $stmt   = mqExec(
            $db,
            'SELECT id FROM reports WHERE year = ? AND bhw_name = ? AND barangay = ?',
            'iss',
            [(int)$header['year'], trim($header['bhw_name']), trim($header['barangay'])]
        );
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $db->rollback();
            jsonError("A report for this BHW and barangay in {$header['year']} already exists.", 409);
        }

        $stmt = mqExec(
            $db,
            'INSERT INTO reports (year, bhw_name, barangay, area) VALUES (?,?,?,?)',
            'isss',
            [(int)$header['year'], trim($header['bhw_name']), trim($header['barangay']), trim($header['area'])]
        );
        $newId = (int) $db->insert_id;
        $stmt->close();

        upsertAccomplishments($db, $newId, $tableValues);
        upsertFamilyPlanning($db, $newId, $familyPlanning);

        $db->commit();
        jsonResponse(['id' => $newId, 'message' => 'Report created successfully.'], 201);
    } catch (Throwable $e) {
        $db->rollback();
        error_log('Create report error: ' . $e->getMessage());
        jsonError('Failed to create report: ' . $e->getMessage(), 500);
    }
}

/** PUT /api/reports/{id} */
function updateReport(mysqli $db, ?int $reportId): never
{
    if ($reportId === null) jsonError('Invalid report ID.', 400);

    $body           = json_decode(file_get_contents('php://input'), true) ?? [];
    $header         = $body['header']         ?? [];
    $tableValues    = $body['tableValues']    ?? [];
    $familyPlanning = $body['familyPlanning'] ?? [];

    $ve = validateHeader($header);
    if ($ve) jsonError($ve, 400);

    $db->begin_transaction();
    try {
        $stmt   = mqExec($db, 'SELECT id FROM reports WHERE id = ?', 'i', [$reportId]);
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows === 0) {
            $db->rollback();
            jsonError('Report not found.', 404);
        }

        $stmt = mqExec(
            $db,
            'UPDATE reports SET year=?, bhw_name=?, barangay=?, area=?, updated_at=NOW() WHERE id=?',
            'isssi',
            [(int)$header['year'], trim($header['bhw_name']), trim($header['barangay']), trim($header['area']), $reportId]
        );
        $stmt->close();

        upsertAccomplishments($db, $reportId, $tableValues);
        upsertFamilyPlanning($db, $reportId, $familyPlanning);

        $db->commit();
        jsonResponse(['message' => 'Report updated successfully.']);
    } catch (Throwable $e) {
        $db->rollback();
        error_log('Update report error: ' . $e->getMessage());
        jsonError('Failed to update report: ' . $e->getMessage(), 500);
    }
}

/** DELETE /api/reports/{id} */
function deleteReport(mysqli $db, ?int $reportId): never
{
    if ($reportId === null) jsonError('Invalid report ID.', 400);

    try {
        $stmt   = mqExec($db, 'SELECT id FROM reports WHERE id = ?', 'i', [$reportId]);
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows === 0) jsonError('Report not found.', 404);

        $stmt = mqExec($db, 'DELETE FROM reports WHERE id = ?', 'i', [$reportId]);
        $stmt->close();

        jsonResponse(['message' => 'Report deleted successfully.']);
    } catch (Throwable $e) {
        error_log('Delete report error: ' . $e->getMessage());
        jsonError('Failed to delete report.', 500);
    }
}
