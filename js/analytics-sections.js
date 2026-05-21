function collectTableRows(tbodyId) {
  const tbody = document.getElementById(tbodyId);
  if (!tbody) return [];

  return Array.from(tbody.querySelectorAll('tr')).map(tr => {
    const row = {};

    // Prefer data-field attributes
    tr.querySelectorAll('[data-field]').forEach(el => {
      row[el.dataset.field] = el.value ?? el.textContent.trim();
    });

    // If no data-field attributes found, fall back to positional fields
    if (Object.keys(row).length === 0) {
      const cells = tr.querySelectorAll('td');
      cells.forEach((td, i) => {
        const input = td.querySelector('input, select, textarea');
        row[`col_${i}`] = input ? input.value : td.textContent.trim();
      });
    }

    // Always capture the row indicator/label from the first cell
    const firstCell = tr.querySelector('td:first-child');
    if (firstCell && !row.indicator) {
      const input = firstCell.querySelector('input');
      row.indicator = input ? input.value : firstCell.textContent.trim();
    }

    return row;
  }).filter(row => Object.keys(row).length > 0); // skip completely empty rows
}

async function saveSectionH() {
  const btn     = document.getElementById('btn-save-vital');
  const spinner = document.getElementById('vital-spinner');
  const status  = document.getElementById('vital-save-status');

  // ── Collect data ──────────────────────────────────────────────
  const payload = {
    // If your form has a record_id (edit mode), include it:
    // record_id: document.getElementById('record-id')?.value ?? null,
    mortality: collectTableRows('vital-mortality-body'),
    natality:  collectTableRows('vital-natality-body'),
  };
console.log(payload);
  if (payload.mortality.length === 0 && payload.natality.length === 0) {
    status.textContent = '⚠ No data found to save.';
    status.className   = 'text-sm font-medium text-yellow-600';
    return;
  }

  // ── UI: loading state ─────────────────────────────────────────
  btn.disabled       = true;
  spinner.classList.remove('hidden');
  status.textContent = '';

  try {
    const response = await fetch('../controller/save_vital_statistics.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(payload),
    });

    const result = await response.json();

    if (result.success) {
      status.textContent = result.message;
      status.className   = 'text-sm font-medium text-green-600';
      console.log(result);
    } else {
      status.textContent = '✗ Error: ' + (result.message ?? 'Unknown error');
      status.className   = 'text-sm font-medium text-red-600';
    }
  } catch (err) {
    console.error(err);
    status.textContent = '✗ Network error. Please try again.';
    status.className   = 'text-sm font-medium text-red-600';
  } finally {
    btn.disabled = false;
    spinner.classList.add('hidden');
  }
}

async function saveSectionG() {
  const btn     = document.getElementById('btn-save-infectious');
  const spinner = document.getElementById('infectious-spinner');
  const status  = document.getElementById('infectious-save-status');

  // ── Collect data ──────────────────────────────────────────────
  const payload = {
    // If your form has a record_id (edit mode), include it:
    // record_id: document.getElementById('record-id')?.value ?? null,
    filariasis: collectTableRows('g-filariasis-body'),
    rabies:  collectTableRows('g-rabies-body'),
    schistosomiasis:  collectTableRows('g-schistosomiasis-body'),
    sth:  collectTableRows('g-sth-body'),
    leprosy:  collectTableRows('g-leprosy-body'),
    hiv:  collectTableRows('g-hiv-body'),
  };
console.log(payload);

// ── UI: loading state ─────────────────────────────────────────
  btn.disabled       = true;
  spinner.classList.remove('hidden');
  status.textContent = '';

  try {
    const response = await fetch('../controller/save_sectionG.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(payload),
    });

    const result = await response.json();

    if (result.success) {
      status.textContent = result.message;
      status.className   = 'text-sm font-medium text-green-600';
      console.log(result);
    } else {
      status.textContent = '✗ Error: ' + (result.message ?? 'Unknown error');
      status.className   = 'text-sm font-medium text-red-600';
    }
  } catch (err) {
    console.error(err);
    status.textContent = '✗ Network error. Please try again.';
    status.className   = 'text-sm font-medium text-red-600';
  } finally {
    btn.disabled = false;
    spinner.classList.add('hidden');
  }
}

async function saveSectionF() {
  const btn     = document.getElementById('btn-save-sectionF');
  const spinner = document.getElementById('sectionF-spinner');
  const status  = document.getElementById('sectionF-save-status');

  // ── Collect data ──────────────────────────────────────────────
  const payload = {
    // If your form has a record_id (edit mode), include it:
    // record_id: document.getElementById('record-id')?.value ?? null,
    waterBody: collectTableRows('f-water-body'),
    sanitationBody:  collectTableRows('f-sanitation-body'),
  };
console.log(payload);

// ── UI: loading state ─────────────────────────────────────────
  btn.disabled       = true;
  spinner.classList.remove('hidden');
  status.textContent = '';

  try {
    const response = await fetch('../controller/save_sectionF.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(payload),
    });

    const result = await response.json();

    if (result.success) {
      status.textContent = result.message;
      status.className   = 'text-sm font-medium text-green-600';
      console.log(result);
    } else {
      status.textContent = '✗ Error: ' + (result.message ?? 'Unknown error');
      status.className   = 'text-sm font-medium text-red-600';
    }
  } catch (err) {
    console.error(err);
    status.textContent = '✗ Network error. Please try again.';
    status.className   = 'text-sm font-medium text-red-600';
  } finally {
    btn.disabled = false;
    spinner.classList.add('hidden');
  }
}

async function saveSectionE() {
  const btn     = document.getElementById('btn-save-sectionE');
  const spinner = document.getElementById('sectionE-spinner');
  const status  = document.getElementById('sectionE-save-status');

  // ── Collect data ──────────────────────────────────────────────
  const payload = {
    // If your form has a record_id (edit mode), include it:
    // record_id: document.getElementById('record-id')?.value ?? null,
    e1: collectTableRows('e1-body'),
    e2: collectTableRows('e2-body'),
    e3: collectTableRows('e3-body'),
    e4: collectTableRows('e4-body'),
    e5: collectTableRows('e5-body'),
    e6: collectTableRows('e6-body'),
    e7: collectTableRows('e7-body'),
    e8: collectTableRows('e8-body'),
  };
console.log(payload);

// ── UI: loading state ─────────────────────────────────────────
  btn.disabled       = true;
  spinner.classList.remove('hidden');
  status.textContent = '';

  try {
    const response = await fetch('../controller/save_sectionE.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(payload),
    });

    const result = await response.json();

    if (result.success) {
      status.textContent = result.message;
      status.className   = 'text-sm font-medium text-green-600';
      console.log(result);
    } else {
      status.textContent = '✗ Error: ' + (result.message ?? 'Unknown error');
      status.className   = 'text-sm font-medium text-red-600';
    }
  } catch (err) {
    console.error(err);
    status.textContent = '✗ Network error. Please try again.';
    status.className   = 'text-sm font-medium text-red-600';
  } finally {
    btn.disabled = false;
    spinner.classList.add('hidden');
  }
}

async function saveSectionD() {
  const btn     = document.getElementById('btn-save-sectionD');
  const spinner = document.getElementById('sectionD-spinner');
  const status  = document.getElementById('sectionD-save-status');

  // ── Collect data ──────────────────────────────────────────────
  const payload = {
    // If your form has a record_id (edit mode), include it:
    // record_id: document.getElementById('record-id')?.value ?? null,
    oral: collectTableRows('oral-body'),
  };
console.log(payload);

// ── UI: loading state ─────────────────────────────────────────
  btn.disabled       = true;
  spinner.classList.remove('hidden');
  status.textContent = '';

  try {
    const response = await fetch('../controller/save_sectionD.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(payload),
    });

    const result = await response.json();

    if (result.success) {
      status.textContent = result.message;
      status.className   = 'text-sm font-medium text-green-600';
      console.log(result);
    } else {
      status.textContent = '✗ Error: ' + (result.message ?? 'Unknown error');
      status.className   = 'text-sm font-medium text-red-600';
    }
  } catch (err) {
    console.error(err);
    status.textContent = '✗ Network error. Please try again.';
    status.className   = 'text-sm font-medium text-red-600';
  } finally {
    btn.disabled = false;
    spinner.classList.add('hidden');
  }
}

async function saveSectionC() {
  const btn     = document.getElementById('btn-save-sectionC');
  const spinner = document.getElementById('sectionC-spinner');
  const status  = document.getElementById('sectionC-save-status');

  // ── Collect data ──────────────────────────────────────────────
  const payload = {
    // If your form has a record_id (edit mode), include it:
    // record_id: document.getElementById('record-id')?.value ?? null,
    a1: collectTableRows('immun-a1-body'),
    a2: collectTableRows('immun-a2-body'),
    a3: collectTableRows('immun-a3-body'),
    a4: collectTableRows('immun-a4-body'),
    nutrition: collectTableRows('nutrition-body'),
    sick: collectTableRows('sick-body'),
  };
console.log(payload);

// ── UI: loading state ─────────────────────────────────────────
  btn.disabled       = true;
  spinner.classList.remove('hidden');
  status.textContent = '';

  try {
    const response = await fetch('../controller/save_sectionC.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(payload),
    });

    const result = await response.json();

    if (result.success) {
      status.textContent = result.message;
      status.className   = 'text-sm font-medium text-green-600';
      console.log(result);
    } else {
      status.textContent = '✗ Error: ' + (result.message ?? 'Unknown error');
      status.className   = 'text-sm font-medium text-red-600';
    }
  } catch (err) {
    console.error(err);
    status.textContent = '✗ Network error. Please try again.';
    status.className   = 'text-sm font-medium text-red-600';
  } finally {
    btn.disabled = false;
    spinner.classList.add('hidden');
  }
}

async function saveSectionB() {
  const btn     = document.getElementById('btn-save-sectionB');
  const spinner = document.getElementById('sectionB-spinner');
  const status  = document.getElementById('sectionB-save-status');

  // ── Collect data ──────────────────────────────────────────────
  const payload = {
    // If your form has a record_id (edit mode), include it:
    // record_id: document.getElementById('record-id')?.value ?? null,
    prenatal: collectTableRows('prenatal-body'),
  };
console.log(payload);

// ── UI: loading state ─────────────────────────────────────────
  btn.disabled       = true;
  spinner.classList.remove('hidden');
  status.textContent = '';

  try {
    const response = await fetch('../controller/save_sectionB.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(payload),
    });

    const result = await response.json();

    if (result.success) {
      status.textContent = result.message;
      status.className   = 'text-sm font-medium text-green-600';
      console.log(result);
    } else {
      status.textContent = '✗ Error: ' + (result.message ?? 'Unknown error');
      status.className   = 'text-sm font-medium text-red-600';
    }
  } catch (err) {
    console.error(err);
    status.textContent = '✗ Network error. Please try again.';
    status.className   = 'text-sm font-medium text-red-600';
  } finally {
    btn.disabled = false;
    spinner.classList.add('hidden');
  }
}

async function saveSectionA() {
  const btn     = document.getElementById('btn-save-sectionA');
  const spinner = document.getElementById('sectionA-spinner');
  const status  = document.getElementById('sectionA-save-status');

  // ── Collect data ──────────────────────────────────────────────
  const payload = {
    // If your form has a record_id (edit mode), include it:
    // record_id: document.getElementById('record-id')?.value ?? null,
    demand: collectTableRows('demand-body'),
    modern: collectTableRows('modern-fp-body'),
  };
console.log(payload);

// ── UI: loading state ─────────────────────────────────────────
  btn.disabled       = true;
  spinner.classList.remove('hidden');
  status.textContent = '';

  try {
    const response = await fetch('../controller/save_sectionA.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(payload),
    });

    const result = await response.json();

    if (result.success) {
      status.textContent = result.message;
      status.className   = 'text-sm font-medium text-green-600';
      console.log(result);
    } else {
      status.textContent = '✗ Error: ' + (result.message ?? 'Unknown error');
      status.className   = 'text-sm font-medium text-red-600';
    }
  } catch (err) {
    console.error(err);
    status.textContent = '✗ Network error. Please try again.';
    status.className   = 'text-sm font-medium text-red-600';
  } finally {
    btn.disabled = false;
    spinner.classList.add('hidden');
  }
}