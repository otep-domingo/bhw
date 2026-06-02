// routes/reports.js
// No authentication - open access

const express = require('express');
const db      = require('../config/db');
const router  = express.Router();

const MONTHS = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];

/* -------------------------------------------------------
   HELPER: validate report header fields
------------------------------------------------------- */
function validateHeader({ year, bhw_name, barangay, area }) {
  if (!year || isNaN(year) || year < 2000 || year > 2100)
    return 'A valid year (2000-2100) is required.';
  if (!bhw_name || !bhw_name.trim()) return 'BHW name is required.';
  if (!barangay  || !barangay.trim()) return 'Barangay is required.';
  if (!area      || !area.trim())     return 'Area is required.';
  return null;
}

/* -------------------------------------------------------
   HELPER: upsert accomplishment_data rows
   row_total is computed in JS — avoids generated column issues
------------------------------------------------------- */
async function upsertAccomplishments(conn, report_id, tableValues) {
  await conn.query('DELETE FROM accomplishment_data WHERE report_id = ?', [report_id]);

  if (!tableValues || Object.keys(tableValues).length === 0) return;

  const rows = [];
  Object.entries(tableValues).forEach(([row_key, monthData]) => {
    if (!monthData || typeof monthData !== 'object') return;
    const vals = MONTHS.map(m => {
      const v = parseInt(monthData[m]);
      return isNaN(v) || v < 0 ? 0 : v;
    });
    const row_total = vals.reduce((sum, v) => sum + v, 0);
    rows.push([report_id, row_key, ...vals, row_total]);
  });

  if (rows.length === 0) return;

  await conn.query(
    `INSERT INTO accomplishment_data
       (report_id, row_key,
        jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, \`dec\`,
        row_total)
     VALUES ?`,
    [rows]
  );
}

/* -------------------------------------------------------
   HELPER: upsert family_planning_methods
------------------------------------------------------- */
async function upsertFamilyPlanning(conn, report_id, fp) {
  if (!fp) return;
  await conn.query(
    `INSERT INTO family_planning_methods
       (report_id, fp_pills, fp_injectables, fp_btl, fp_vasectomy,
        fp_implant, fp_condom, fp_cm, fp_bbt, fp_stm, fp_sdm)
     VALUES (?,?,?,?,?,?,?,?,?,?,?)
     ON DUPLICATE KEY UPDATE
       fp_pills=VALUES(fp_pills), fp_injectables=VALUES(fp_injectables),
       fp_btl=VALUES(fp_btl), fp_vasectomy=VALUES(fp_vasectomy),
       fp_implant=VALUES(fp_implant), fp_condom=VALUES(fp_condom),
       fp_cm=VALUES(fp_cm), fp_bbt=VALUES(fp_bbt),
       fp_stm=VALUES(fp_stm), fp_sdm=VALUES(fp_sdm)`,
    [
      report_id,
      fp.fp_pills       ? 1 : 0,
      fp.fp_injectables ? 1 : 0,
      fp.fp_btl         ? 1 : 0,
      fp.fp_vasectomy   ? 1 : 0,
      fp.fp_implant     ? 1 : 0,
      fp.fp_condom      ? 1 : 0,
      fp.fp_cm          ? 1 : 0,
      fp.fp_bbt         ? 1 : 0,
      fp.fp_stm         ? 1 : 0,
      fp.fp_sdm         ? 1 : 0
    ]
  );
}

/* -------------------------------------------------------
   GET /api/reports
------------------------------------------------------- */
router.get('/', async (req, res) => {
  try {
    const [rows] = await db.query(
      `SELECT id, year, bhw_name, barangay, area, updated_at
       FROM reports ORDER BY year DESC, bhw_name ASC`
    );
    res.json(rows);
  } catch (err) {
    console.error('List reports error:', err.message);
    res.status(500).json({ error: 'Failed to fetch reports.' });
  }
});

/* -------------------------------------------------------
   GET /api/reports/:id
------------------------------------------------------- */
router.get('/:id', async (req, res) => {
  const reportId = parseInt(req.params.id);
  if (isNaN(reportId)) return res.status(400).json({ error: 'Invalid report ID.' });

  try {
    const [reports] = await db.query('SELECT * FROM reports WHERE id = ?', [reportId]);
    if (reports.length === 0) return res.status(404).json({ error: 'Report not found.' });

    const [accRows] = await db.query(
      `SELECT row_key, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, \`dec\`
       FROM accomplishment_data WHERE report_id = ?`,
      [reportId]
    );

    const tableValues = {};
    accRows.forEach(row => {
      tableValues[row.row_key] = {};
      MONTHS.forEach(m => { tableValues[row.row_key][m] = row[m]; });
    });

    const [fpRows] = await db.query(
      'SELECT * FROM family_planning_methods WHERE report_id = ?', [reportId]
    );
    const fp = fpRows[0] || {};

    const r = reports[0];
    res.json({
      id: r.id,
      header: { year: r.year, bhw_name: r.bhw_name, barangay: r.barangay, area: r.area },
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
    console.error('Get report error:', err.message);
    res.status(500).json({ error: 'Failed to fetch report.' });
  }
});

/* -------------------------------------------------------
   POST /api/reports  - create
------------------------------------------------------- */
router.post('/', async (req, res) => {
  const { header, tableValues, familyPlanning } = req.body;

  const ve = validateHeader(header || {});
  if (ve) return res.status(400).json({ error: ve });

  const conn = await db.getConnection();
  try {
    await conn.beginTransaction();

    const [dupe] = await conn.query(
      'SELECT id FROM reports WHERE year=? AND bhw_name=? AND barangay=?',
      [header.year, header.bhw_name.trim(), header.barangay.trim()]
    );
    if (dupe.length > 0) {
      await conn.rollback();
      return res.status(409).json({ error: `A report for this BHW and barangay in ${header.year} already exists.` });
    }

    const [result] = await conn.query(
      'INSERT INTO reports (year, bhw_name, barangay, area) VALUES (?,?,?,?)',
      [header.year, header.bhw_name.trim(), header.barangay.trim(), header.area.trim()]
    );

    await upsertAccomplishments(conn, result.insertId, tableValues);
    await upsertFamilyPlanning(conn, result.insertId, familyPlanning);

    await conn.commit();
    res.status(201).json({ id: result.insertId, message: 'Report created successfully.' });

  } catch (err) {
    await conn.rollback();
    console.error('Create report error:', err.message);
    res.status(500).json({ error: 'Failed to create report: ' + err.message });
  } finally {
    conn.release();
  }
});

/* -------------------------------------------------------
   PUT /api/reports/:id  - update
------------------------------------------------------- */
router.put('/:id', async (req, res) => {
  const reportId = parseInt(req.params.id);
  if (isNaN(reportId)) return res.status(400).json({ error: 'Invalid report ID.' });

  const { header, tableValues, familyPlanning } = req.body;
  const ve = validateHeader(header || {});
  if (ve) return res.status(400).json({ error: ve });

  const conn = await db.getConnection();
  try {
    await conn.beginTransaction();

    const [existing] = await conn.query('SELECT id FROM reports WHERE id=?', [reportId]);
    if (existing.length === 0) {
      await conn.rollback();
      return res.status(404).json({ error: 'Report not found.' });
    }

    await conn.query(
      'UPDATE reports SET year=?, bhw_name=?, barangay=?, area=?, updated_at=NOW() WHERE id=?',
      [header.year, header.bhw_name.trim(), header.barangay.trim(), header.area.trim(), reportId]
    );

    await upsertAccomplishments(conn, reportId, tableValues);
    await upsertFamilyPlanning(conn, reportId, familyPlanning);

    await conn.commit();
    res.json({ message: 'Report updated successfully.' });

  } catch (err) {
    await conn.rollback();
    console.error('Update report error:', err.message);
    res.status(500).json({ error: 'Failed to update report: ' + err.message });
  } finally {
    conn.release();
  }
});

/* -------------------------------------------------------
   DELETE /api/reports/:id
------------------------------------------------------- */
router.delete('/:id', async (req, res) => {
  const reportId = parseInt(req.params.id);
  if (isNaN(reportId)) return res.status(400).json({ error: 'Invalid report ID.' });

  try {
    const [existing] = await db.query('SELECT id FROM reports WHERE id=?', [reportId]);
    if (existing.length === 0) return res.status(404).json({ error: 'Report not found.' });

    await db.query('DELETE FROM reports WHERE id=?', [reportId]);
    res.json({ message: 'Report deleted successfully.' });

  } catch (err) {
    console.error('Delete report error:', err.message);
    res.status(500).json({ error: 'Failed to delete report.' });
  }
});

module.exports = router;