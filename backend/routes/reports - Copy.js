// routes/reports.js
// All routes are protected by JWT auth middleware
//
// GET    /api/reports          - list reports (own + same barangay)
// GET    /api/reports/:id      - get single report with all data
// POST   /api/reports          - create new report
// PUT    /api/reports/:id      - update existing report
// DELETE /api/reports/:id      - delete report (own only)

const express = require('express');
const db      = require('../config/db');
const auth    = require('../middleware/auth');

const router = express.Router();

// All routes require authentication
router.use(auth);

/* -------------------------------------------------------
   HELPER: validate report header fields
------------------------------------------------------- */
function validateHeader({ year, bhw_name, barangay, area }) {
  if (!year || isNaN(year) || year < 2000 || year > 2100)
    return 'A valid year (2000–2100) is required.';
  if (!bhw_name || !bhw_name.trim())
    return 'BHW name is required.';
  if (!barangay || !barangay.trim())
    return 'Barangay is required.';
  if (!area || !area.trim())
    return 'Area is required.';
  return null;
}

/* -------------------------------------------------------
   HELPER: upsert accomplishment_data rows
   Replaces all rows for a report in one transaction
------------------------------------------------------- */
async function upsertAccomplishments(conn, report_id, tableValues) {
  // Delete existing rows for this report
  await conn.query('DELETE FROM accomplishment_data WHERE report_id = ?', [report_id]);

  if (!tableValues || Object.keys(tableValues).length === 0) return;

  const MONTHS = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
  const rows = [];

  Object.entries(tableValues).forEach(([row_key, monthData]) => {
    const vals = MONTHS.map(m => parseInt(monthData[m]) || 0);
    rows.push([report_id, row_key, ...vals]);
  });

  if (rows.length === 0) return;

  // Bulk insert
  await conn.query(
    `INSERT INTO accomplishment_data
       (report_id, row_key, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, \`dec\`)
     VALUES ?`,
    [rows]
  );
}

/* -------------------------------------------------------
   HELPER: upsert family_planning_methods row
------------------------------------------------------- */
async function upsertFamilyPlanning(conn, report_id, fp) {
  if (!fp) return;
  await conn.query(
    `INSERT INTO family_planning_methods
       (report_id, fp_pills, fp_injectables, fp_btl, fp_vasectomy, fp_implant,
        fp_condom, fp_cm, fp_bbt, fp_stm, fp_sdm)
     VALUES (?,?,?,?,?,?,?,?,?,?,?)
     ON DUPLICATE KEY UPDATE
       fp_pills=VALUES(fp_pills), fp_injectables=VALUES(fp_injectables),
       fp_btl=VALUES(fp_btl), fp_vasectomy=VALUES(fp_vasectomy),
       fp_implant=VALUES(fp_implant), fp_condom=VALUES(fp_condom),
       fp_cm=VALUES(fp_cm), fp_bbt=VALUES(fp_bbt),
       fp_stm=VALUES(fp_stm), fp_sdm=VALUES(fp_sdm)`,
    [
      report_id,
      fp.fp_pills        ? 1 : 0,
      fp.fp_injectables  ? 1 : 0,
      fp.fp_btl          ? 1 : 0,
      fp.fp_vasectomy    ? 1 : 0,
      fp.fp_implant      ? 1 : 0,
      fp.fp_condom       ? 1 : 0,
      fp.fp_cm           ? 1 : 0,
      fp.fp_bbt          ? 1 : 0,
      fp.fp_stm          ? 1 : 0,
      fp.fp_sdm          ? 1 : 0
    ]
  );
}

/* -------------------------------------------------------
   GET /api/reports
   Returns reports belonging to the logged-in user
   AND reports from the same barangay (other BHWs)
------------------------------------------------------- */
router.get('/', async (req, res) => {
  try {
    const [rows] = await db.query(
      `SELECT r.id, r.year, r.bhw_name, r.barangay, r.area,
              r.user_id, u.full_name, r.updated_at,
              (r.user_id = ?) AS is_own
       FROM reports r
       JOIN users u ON u.id = r.user_id
       WHERE r.user_id = ?
          OR r.barangay = ?
       ORDER BY r.year DESC, r.bhw_name ASC`,
      [req.user.id, req.user.id, req.user.barangay]
    );
    res.json(rows);
  } catch (err) {
    console.error('List reports error:', err);
    res.status(500).json({ error: 'Failed to fetch reports.' });
  }
});

/* -------------------------------------------------------
   GET /api/reports/:id
   Returns a single report with accomplishments + FP methods
   Accessible if: own report OR same barangay
------------------------------------------------------- */
router.get('/:id', async (req, res) => {
  const reportId = parseInt(req.params.id);
  if (isNaN(reportId)) return res.status(400).json({ error: 'Invalid report ID.' });

  try {
    // Fetch report header
    const [reports] = await db.query(
      'SELECT * FROM reports WHERE id = ?', [reportId]
    );
    if (reports.length === 0) return res.status(404).json({ error: 'Report not found.' });

    const report = reports[0];

    // Access control: own report OR same barangay
    if (report.user_id !== req.user.id && report.barangay !== req.user.barangay) {
      return res.status(403).json({ error: 'Access denied.' });
    }

    // Fetch accomplishment data
    const [accRows] = await db.query(
      `SELECT row_key, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, \`dec\`, row_total
       FROM accomplishment_data WHERE report_id = ?`,
      [reportId]
    );

    // Convert rows to { row_key: { jan, feb, ... } } object
    const tableValues = {};
    const MONTHS = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
    accRows.forEach(row => {
      tableValues[row.row_key] = {};
      MONTHS.forEach(m => { tableValues[row.row_key][m] = row[m]; });
    });

    // Fetch family planning methods
    const [fpRows] = await db.query(
      'SELECT * FROM family_planning_methods WHERE report_id = ?', [reportId]
    );
    const fp = fpRows.length > 0 ? fpRows[0] : {};

    res.json({
      id:      report.id,
      user_id: report.user_id,
      is_own:  report.user_id === req.user.id,
      header: {
        year:     report.year,
        bhw_name: report.bhw_name,
        barangay: report.barangay,
        area:     report.area
      },
      tableValues,
      familyPlanning: {
        fp_pills:       !!fp.fp_pills,
        fp_injectables: !!fp.fp_injectables,
        fp_btl:         !!fp.fp_btl,
        fp_vasectomy:   !!fp.fp_vasectomy,
        fp_implant:     !!fp.fp_implant,
        fp_condom:      !!fp.fp_condom,
        fp_cm:          !!fp.fp_cm,
        fp_bbt:         !!fp.fp_bbt,
        fp_stm:         !!fp.fp_stm,
        fp_sdm:         !!fp.fp_sdm
      }
    });

  } catch (err) {
    console.error('Get report error:', err);
    res.status(500).json({ error: 'Failed to fetch report.' });
  }
});

/* -------------------------------------------------------
   POST /api/reports
   Creates a new report for the logged-in user
   Body: { header: { year, bhw_name, barangay, area }, tableValues, familyPlanning }
------------------------------------------------------- */
router.post('/', async (req, res) => {
  const { header, tableValues, familyPlanning } = req.body;

  const validationError = validateHeader(header || {});
  if (validationError) return res.status(400).json({ error: validationError });

  const conn = await db.getConnection();
  try {
    await conn.beginTransaction();

    // Check for duplicate: same user + same year
    const [dupe] = await conn.query(
      'SELECT id FROM reports WHERE user_id = ? AND year = ?',
      [req.user.id, header.year]
    );
    if (dupe.length > 0) {
      await conn.rollback();
      return res.status(409).json({ error: `A report for year ${header.year} already exists. Use update instead.` });
    }

    // Insert report
    const [result] = await conn.query(
      `INSERT INTO reports (user_id, year, bhw_name, barangay, area)
       VALUES (?, ?, ?, ?, ?)`,
      [req.user.id, header.year, header.bhw_name.trim(), header.barangay.trim(), header.area.trim()]
    );
    const report_id = result.insertId;

    await upsertAccomplishments(conn, report_id, tableValues);
    await upsertFamilyPlanning(conn, report_id, familyPlanning);

    await conn.commit();

    res.status(201).json({ id: report_id, message: 'Report created successfully.' });

  } catch (err) {
    await conn.rollback();
    console.error('Create report error:', err);
    res.status(500).json({ error: 'Failed to create report.' });
  } finally {
    conn.release();
  }
});

/* -------------------------------------------------------
   PUT /api/reports/:id
   Updates an existing report (own reports only)
   Body: { header, tableValues, familyPlanning }
------------------------------------------------------- */
router.put('/:id', async (req, res) => {
  const reportId = parseInt(req.params.id);
  if (isNaN(reportId)) return res.status(400).json({ error: 'Invalid report ID.' });

  const { header, tableValues, familyPlanning } = req.body;

  const validationError = validateHeader(header || {});
  if (validationError) return res.status(400).json({ error: validationError });

  const conn = await db.getConnection();
  try {
    await conn.beginTransaction();

    // Verify ownership
    const [existing] = await conn.query(
      'SELECT id, user_id FROM reports WHERE id = ?', [reportId]
    );
    if (existing.length === 0) {
      await conn.rollback();
      return res.status(404).json({ error: 'Report not found.' });
    }
    if (existing[0].user_id !== req.user.id) {
      await conn.rollback();
      return res.status(403).json({ error: 'You can only edit your own reports.' });
    }

    // Update report header
    await conn.query(
      `UPDATE reports SET year=?, bhw_name=?, barangay=?, area=?, updated_at=NOW()
       WHERE id = ?`,
      [header.year, header.bhw_name.trim(), header.barangay.trim(), header.area.trim(), reportId]
    );

    await upsertAccomplishments(conn, reportId, tableValues);
    await upsertFamilyPlanning(conn, reportId, familyPlanning);

    await conn.commit();
    res.json({ message: 'Report updated successfully.' });

  } catch (err) {
    await conn.rollback();
    console.error('Update report error:', err);
    res.status(500).json({ error: 'Failed to update report.' });
  } finally {
    conn.release();
  }
});

/* -------------------------------------------------------
   DELETE /api/reports/:id
   Deletes a report (own reports only)
------------------------------------------------------- */
router.delete('/:id', async (req, res) => {
  const reportId = parseInt(req.params.id);
  if (isNaN(reportId)) return res.status(400).json({ error: 'Invalid report ID.' });

  try {
    const [existing] = await db.query(
      'SELECT id, user_id FROM reports WHERE id = ?', [reportId]
    );
    if (existing.length === 0) return res.status(404).json({ error: 'Report not found.' });
    if (existing[0].user_id !== req.user.id) {
      return res.status(403).json({ error: 'You can only delete your own reports.' });
    }

    // Cascades delete accomplishment_data and family_planning_methods
    await db.query('DELETE FROM reports WHERE id = ?', [reportId]);
    res.json({ message: 'Report deleted successfully.' });

  } catch (err) {
    console.error('Delete report error:', err);
    res.status(500).json({ error: 'Failed to delete report.' });
  }
});

module.exports = router;
