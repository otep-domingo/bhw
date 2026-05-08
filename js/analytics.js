const defaultConfig = {
  report_month: '',
  report_year: '',
  barangay_name: '',
  bhs_name: '',
  municipality: '',
  province: '',
  population: ''
};
let config = { ...defaultConfig };
let allReportData = [];

const fpMethods = ['BTL', 'NSV', 'Condom', 'Pills (a. Pills-POP, b. Implants-PP)', 'Injectables', 'Implant (a. Implants-Interval b. Implants PP)', 'IUD (a. IUD- Interval b. IUD PP)', 'NFP-LAM', 'NFP-BBT', 'NFP-CMM', 'NFP-STM', 'NFP-SDM', 'Total Current Users'];

const prenatalIndicators = [
  '1a. Women who gave birth with at least 4 prenatal check-ups',
  '1b. Total No. of Women who delivered and completed at least 8ANC=(a+b)',
  'a. No of Women who delivered and provided 1st to 8th ANC on schedule',
  'b. No of Women who delivered and completed at least 8ANC TRANS IN from other LGUs',
  '1c. Total No of Women who delivered and were tracked during pregnancy = (a+b)',
  'a. No of women who delivered and were tracked during pregnancy',
  'b. No of TRANS IN from other LGUs who delivered',
  'c. No of TRANS OUT (with MOV) before completing 8ANC',
  '2a. No of pregnant women seen in the first trimester who have normal BMI',
  '2b. No of pregnant women seen in the first trimester who have low BMI',
  '2c. No of pregnant women seen in the first trimester who have high BMI',
  '3a. No of pregnant women for the first time given at least 2 doses of Tetanus diphtheria (Td) vaccination',
  '3b. No of Pregnant Women for the 2nd or more times given at least 3 doses of Td vaccination (Td2 plus)',
  '4. No of Pregnant Women who completed the dose of iron with folic acid supplementation',
  '5. No of pregnant women completed the dose Multiple Micronutrient Supplementation',
  '6. No of high risk women who completed the dose of calcium carbonate',
  '7. No of pregnant women given one dose of deworming tablet.',
  '8a. No of pregnant women screened for Hepatitis B',
  '8b. No of pregnant women screened reactive for Hepatitis B',
  '9a. No of pregnant women screened for Anemia',
  '9b. No of pregnant women diagnosed with Anemia',
  '10a. No of pregnant women screened for Gestational Diabetes Melitus',
  '10b. No of pregnant women tested for positive Gestational Diabetes Melitus'
];

const nutritionIndicatorsModal = [
  'Early Breastfeeding (<1hr)',
  'LBW Infants – Iron',
  'Exclusive Breastfeeding',
  'Breastfeeding + Complementary Feeding',
  'Vit A (6–11 months)',
  'Vit A (12–59 months)',
  'MNP (6–11 months)',
  'MNP (12–23 months)',
  'LNS-SQ (6–11 months)',
  'LNS-SQ (12–23 months)',
  'Children Seen (0–59 months)',
  'MAM Identified',
  'SAM Identified',
  'MAM Enrolled to SFP',
  'SFP Cured',
  'SFP Non-Cured',
  'SFP Defaulted',
  'SFP Died',
  'SAM Admitted to OTC',
  'OTC Cured',
  'OTC Non-Cured',
  'OTC Defaulted',
  'OTC Died'
];

const oralIndicatorsModal = [
  'Orally Fit (12–59m)',
  'DMFT (5y+)',
  'BOHC (0–11m)',
  'BOHC (1–4y)',
  'BOHC (5–9y)',
  'BOHC (10–14y)',
  'BOHC (15–19y)',
  'BOHC (20–59y)',
  'BOHC (60y+)',
  'BOHC (Pregnant)'
];

const sickIndicatorsModal = [
  'Vit A (Sick 6–11m)',
  'Sick Seen (6–11m)',
  'Vit A (Sick 12–59m)',
  'Sick Seen (12–59m)',
  'Diarrhea Cases Seen',
  'Diarrhea – ORS Only',
  'Diarrhea – ORS + Zinc',
  'Pneumonia Cases Seen',
  'Pneumonia – Antibiotics'
];

const prenatalIndicatorsModal = [
  '1a. ≥4 Prenatal Checkups',
  '1b. Completed 8 ANC',
  '1b-a. 1–8 ANC On Schedule',
  '1b-b. 8 ANC (Trans-in)',
  '1c. Pregnancy Tracked',
  '1c-a. Delivered & Tracked',
  '1c-b. Trans-in Delivered',
  '1c-c. Trans-out before 8 ANC',
  '2a. 1st Trimester Normal BMI',
  '2b. 1st Trimester Low BMI',
  '2c. 1st Trimester High BMI',
  '3a. First Pregnancy ≥2 Td',
  '3b. Repeat Pregnancy ≥3 Td',
  '4. Iron + Folic Completed',
  '5. MMS Completed',
  '6. High-Risk Calcium',
  '7. Deworming Given',
  '8a. Hep B Screened',
  '8b. Hep B Reactive',
  '9a. Anemia Screened',
  '9b. Anemia Diagnosed',
  '10a. GDM Screened',
  '10b. GDM Positive'
];

const immunA1 = ['Children Protected at Birth (CPAB)', 'BCG(with in 0-28 days)', 'BCG(29 days to 1 year old)'];
const immunA2 = ['DPT-HiB-HepB 1', 'DPT-HiB-HepB 2', 'DPT-HiB-HepB 3', 'OPV 1', 'OPV 2', 'OPV 3', 'IPV 1', 'IPV 2', 'PCV 1', 'PCV 2', 'PCV 3', 'MMR 1', 'MMR 2', 'FIC'];
const immunA3 = ['DPT-HiB-HepB 1', 'DPT-HiB-HepB 2', 'DPT-HiB-HepB 3', 'OPV 1', 'OPV 2', 'OPV 3', 'IPV 1', 'IPV 2', 'PCV 1', 'PCV 2', 'PCV 3', 'MMR 1', 'MMR 2', 'CIC'];
const immunA4 = ['HPV 1st dose (9 years old Female only)', 'HPV 2nd dose (9 years old Female only)', 'Grade 1 learners given Td', 'Grade 1 learners given MR', 'Grade 7 learners given Td', 'Grade 7 learners given MR'];

const nutritionIndicators = [
  'Newborns who were initiated on breastfeeding within 1 hour after birth',
  '2a. Infants born with low birth weight (LBW) given complete Iron supplements',
  '2b. Infants exclusively breastfed until 5th month and 29 days',
  '2c. Infants who continued breastfeeding and were introduced to complementary feeding beginning at 6 months of age',
  '3a. Infants aged 6-11 months old who received 1 dose of Vitamin A supplementation',
  '3b. Children aged 12-59 months old who completed 2 doses of Vitamin A Supplementation',
  '4a. Infants aged 6-11 months old who completed routine MNP supplementation',
  '4b. Children aged 12-23 months old who completed routine MNP supplementation',
  '5a. Infants aged 6-11 months old who completed routine LNS-SQ supplementation',
  '5b. Children aged 12-23 months old who completed routine LNS-SQ supplementation',
  'Children 0-59 months old SEEN during the reporting period at health facilities',
  '6a. Identified MAM',
  '6b. Identified SAM',
  'MAM enrolled to SFP',
  '7a. Cured',
  '7b. Non-cured',
  '7c. Defaulted',
  '7d. Died',
  'SAM without complication admitted to OTC',
  '8a. Cured',
  '8b. Non-cured',
  '8c. Defaulted',
  '8d. Died'
];

const sickIndicators = [
  'Sick infants aged 6-11 months old who received Vitamin A capsule aside from routine supplementation',
  '1a. Sick infants aged 6-11 months old seen',
  'Sick infants aged 12-59 months old who received Vitamin A capsule aside from routine supplementation',
  '2a. Sick infants aged 12-59 months old seen',
  'Acute diarrhea cases 0-59 months old seen',
  '3a. 0-59 months old with acute diarrhea who received ORS only',
  '3b. 0-59 months old with acute diarrhea who received ORS and Zinc drops/syrup',
  'Pneumonia cases 0-59 months old seen',
  '4a. 0-59 months old with pneumonia who received antibiotic treatment'
];

const oralIndicators = [
  'Children 12-59 months old who are orally fit upon oral examination or after oral rehabilitation',
  '5 years old and above with cases of Decayed-Missing Filled Teeth (DMFT)',
  'Infants 0-11 months old who received Basic Oral Health Care (BOHC)',
  'Children 1-4 years old who received BOHC',
  'Children 5-9 years old who received BOHC',
  'Adolescents 10-14 years old who received BOHC',
  'Adolescents 15-19 years old who received BOHC',
  'Adults 20-59 years old who received BOHC',
  'Senior citizens 60 years old and above who received BOHC',
  'Pregnant women who received BOHC'
];

const e1Indicators = ['Adults 20-59 years old who were risk assessed using the PhilPEN protocol', '1a. Current smoker', '1b. Binge drinker', '1c. Insufficient physical activity', '1d. Consumed unhealthy diet', '1e. Overweight', '1f. Obese', 'Senior Citizens 60 years old and above who were risk assessed using the PhilPEN protocol', '2a. With history of smoking', '2b. Binge Drinker', '2c. Insufficient physical activities', '2d. Consumed unhealthy diet', '2e. Overweight', '2f. Obese'];
const e2Indicators = ['Adults 20–59 years old assessed and identified as hypertensive using the PhilPEN protocol', 'Hypertensive 20–59 years old provided with antihypertensive medications', '2a. Provided by facility', '2b. Out of pocket', 'Senior citizens 60 years old and above identified as hypertensive using the PhilPEN protocol', 'Hypertensives 60 years old and above provided with hypertensive medications', '4a. Provided by facility', '4b. Out of pocket'];
const e3Indicators = ['Adults 20-59 years old who were identifies with Type II Diabetes using the PhilPEN protocol', 'Type II Diabetics 20-59 years old provided with antidiabetic medications', '2a. Provided by facility (100%)', '2b. Out of pocket', 'Senior Citizens 60 years old and above who were identified with Type II Diabetes using the PhilPEN protocol', 'Type II Diabetics 60 years old and above provided with antidiabetic medications', '4a. Provided by facility (100%)', '4b. Out of pocket'];
const e4Indicators = ['Senior citizens aged 60 years old and above screened for visual acuity', 'Senior citizens aged 60 years old and above screened for visual acuity and identified with eye disease/s', 'Senior citizens identified with eye disease/s and referred to eye care professionals'];
const e5Indicators = ['Senior Citizens Seen who had not previously received PPV upon reaching 60 years old', 'Senior citizens aged 60 years old and above who received one (1) dose of Pneumococcal Polysaccharide Vaccine', 'Senior Citizens Seen', 'Senior citizens aged 60 years old and above who received one (1) dose of Influenza Vaccine'];
const e6Indicators = ['Women aged 30-65 years old screened or assessed for cervical cancer', '1a. VIA', '2a. PapSmear', '3a. HPV DNA', '4a. Assessed Only', 'Women aged 30-65 years found suspicious for cervical cancer', 'Women aged 30-65 years old found suspicious for cervical cancer and linked to care', '3a. Treated', '3b. Referred', 'Women aged 30-65 years old found positive for precancerous lesions', 'Women aged 30-65 years old found positive for precancerous lesions and linked to care', '5a. Treated', '5b. Referred'];
const e7Indicators = ['High-risk asymptomatic or symptomatic women aged 30-69 years old provided with Breast Cancer Early Detection Services', '1a. Clinical Breast Examination', '1b. Mammogram', 'High-risk asymptomatic or symptomatic women aged 30-69 years old found with remarkable or significant results', '2a. Clinical Breast Examination', '2b. Mammogram', 'High-risk asymptomatic or symptomatic women aged 30-69 years old found with remarkable results and linked to care', 'Asymptomatic women aged 50-69 years old screened for breast cancer', '4a. Clinical Breast Examination', '4b. Mammogram', 'Asymptomatic women aged 50-69 years old screened for breast cancer and found with remarkable or significant results', '5b. Mammogram', 'Asymptomatic women aged 50-69 years old screened for breast cancer and found with remarkable or significant results and linked to care'];
const e8Indicators = ['Individual with mental health concern screened using the Mental Health Gap Action Programme (mhGAP)'];

const waterIndicators = ['Households (HHs) with access to improved water supply - Total', '1a. HH with Level I', '1b. HH with Level II', '1c. HH with Level III', 'HH using safely managed drinking water service'];
const sanitationIndicators = ['HH with basic sanitation facility - Total', '1a. HH with pour/flush toilet connected to a septic tank', '1b. HH with pour/flush toilet connected to community sewer/sewerage system or any other approved treatment system', '1c. HH with Ventilated Improved Pit (VIP) Latrine', 'HH using safely managed sanitation service'];

const filariasisIndicators = ['No. of individual examined for lymphatic filariasis', 'No. of individual examined found positive for lymphatic filariasis', 'No. of lymphatic filariasis cases examined with manifestation of either lymphedema, hydrocele, elephantiasis'];
const rabiesIndicators = ['Number of Animal Bites', 'Number of deaths due to Rabies'];
const schistosomiasisIndicators = ['No. of patients seen', 'No. of suspected cases seen', 'No. acute clinically diagnosed cases', 'No. of confirmed acute cases', 'No. of chronic clinically diagnosed cases', 'No. confirmed chronic cases', 'No. of confirmed cases (acute and chronic)', 'No. of cases treated', 'No. of confirmed chronic cases referred to a hospital facility'];
const sthIndicators = ['No. of PSAC, 1-4 years old, who completed 2 doses of deworming tablet', 'SAC, 5-9 years old, who completed 2 doses of deworming tablet', 'Adolescent, 10-19 years old, who completed 2 doses of deworming tablet', 'No. of WRA, 20-49 years old, who completed 2 doses of deworming tablet', 'Pregnant women who completed 1 dose of deworming tablet'];
const leprosyIndicators = ['No. of Leprosy Cases on treatment during reporting period', 'No. of newly detected cases during reporting period'];

const hivIndicators = [
  'No. of pregnant women screened for syphilis - Total',
  '1a. 10-14 years old',
  '1b. 15-19 years old',
  '1c. 20-49 years old',
  'No. of pregnant women tested positive for syphilis - Total',
  '2a. 10-14 years old',
  '2b. 15-19 years old',
  '2c. 20-49 years old',
  'No. of pregnant women screened for HIV - Total',
  '3a. 10-14 years old',
  '3b. 15-19 years old',
  '3c. 20-49 years old',
  'No. of pregnant women screened reactive for HIV - Total',
  '4a. 10-14 years old',
  '4b. 15-19 years old',
  '4c. 20-49 years old'
];

const mortalityIndicators = ['Maternal Mortality - Total', 'a. Direct', 'a1. Resident', 'a2. Non-resident', 'b. Indirect', 'b1. Resident', 'b2. Non-resident'];
const natalityIndicators = ['Live births', 'Adolescent Birth Rate (ABR)', 'a. <10 YEARS OLD', 'b. 10-14 years old', 'c. 15-19 years old', 'Total Deaths', 'Under-five Deaths', 'Infant Deaths', 'Neonatal Deaths', 'Perinatal Deaths - Total', '6a. Fetal Deaths', '6b. Early Neonatal Deaths'];

function calculateTotal(table, row) {
  setTimeout(() => {
    const input0 = document.querySelector(`input[data-table="${table}"][data-row="${row}"][data-col="0"]`);
    const input1 = document.querySelector(`input[data-table="${table}"][data-row="${row}"][data-col="1"]`);
    const input2 = document.querySelector(`input[data-table="${table}"][data-row="${row}"][data-col="2"]`);
    const totalInput = document.querySelector(`input[data-table="${table}"][data-row="${row}"][data-col="t"]`);

    if (input0 && input1 && input2 && totalInput) {
      const val0 = parseInt(input0.value) || 0;
      const val1 = parseInt(input1.value) || 0;
      const val2 = parseInt(input2.value) || 0;
      totalInput.value = val0 + val1 + val2;
    }

    autoRefreshAnalytics();
  }, 10);
}

function calculateTotal2Cols(table, row) {
  setTimeout(() => {
    const inputM = document.querySelector(`input[data-table="${table}"][data-row="${row}"][data-col="m"]`);
    const inputF = document.querySelector(`input[data-table="${table}"][data-row="${row}"][data-col="f"]`);
    const totalInput = document.querySelector(`input[data-table="${table}"][data-row="${row}"][data-col="t"]`);

    if (inputM && inputF && totalInput) {
      const valM = parseInt(inputM.value) || 0;
      const valF = parseInt(inputF.value) || 0;
      totalInput.value = valM + valF;
    }

    autoRefreshAnalytics();
  }, 10);
}

function autoRefreshAnalytics() {
  const section = document.getElementById('analytics-modal');
  if (!section.classList.contains('hidden')) {
    buildAnalytics();
  }
}

function generateModernFPTable() {
  const tbody = document.getElementById('modern-fp-body');
  tbody.innerHTML = '';
  fpMethods.forEach((method, rowIndex) => {
    const tr = document.createElement('tr');
    tr.className = 'hover:bg-gray-50 text-xs';
    
    tr.innerHTML = `
      <td class="border border-gray-300 p-2 text-xs font-semibold">${method}</td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-cu" data-row="${rowIndex}" data-col="0" min="0" onchange="calculateTotal('fp-cu', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-cu" data-row="${rowIndex}" data-col="1" min="0" onchange="calculateTotal('fp-cu', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-cu" data-row="${rowIndex}" data-col="2" min="0" onchange="calculateTotal('fp-cu', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="fp-cu" data-row="${rowIndex}" data-col="t" readonly></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-napm" data-row="${rowIndex}" data-col="0" min="0" onchange="calculateTotal('fp-napm', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-napm" data-row="${rowIndex}" data-col="1" min="0" onchange="calculateTotal('fp-napm', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-napm" data-row="${rowIndex}" data-col="2" min="0" onchange="calculateTotal('fp-napm', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="fp-napm" data-row="${rowIndex}" data-col="t" readonly></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-oa" data-row="${rowIndex}" data-col="0" min="0" onchange="calculateTotal('fp-oa', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-oa" data-row="${rowIndex}" data-col="1" min="0" onchange="calculateTotal('fp-oa', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-oa" data-row="${rowIndex}" data-col="2" min="0" onchange="calculateTotal('fp-oa', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="fp-oa" data-row="${rowIndex}" data-col="t" readonly></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-do" data-row="${rowIndex}" data-col="0" min="0" onchange="calculateTotal('fp-do', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-do" data-row="${rowIndex}" data-col="1" min="0" onchange="calculateTotal('fp-do', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-do" data-row="${rowIndex}" data-col="2" min="0" onchange="calculateTotal('fp-do', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="fp-do" data-row="${rowIndex}" data-col="t" readonly></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-cueo" data-row="${rowIndex}" data-col="0" min="0" onchange="calculateTotal('fp-cueo', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-cueo" data-row="${rowIndex}" data-col="1" min="0" onchange="calculateTotal('fp-cueo', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-cueo" data-row="${rowIndex}" data-col="2" min="0" onchange="calculateTotal('fp-cueo', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="fp-cueo" data-row="${rowIndex}" data-col="t" readonly></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-napm2" data-row="${rowIndex}" data-col="0" min="0" onchange="calculateTotal('fp-napm2', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-napm2" data-row="${rowIndex}" data-col="1" min="0" onchange="calculateTotal('fp-napm2', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="fp-napm2" data-row="${rowIndex}" data-col="2" min="0" onchange="calculateTotal('fp-napm2', ${rowIndex})"></td>
      <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="fp-napm2" data-row="${rowIndex}" data-col="t" readonly></td>
    `;
    tbody.appendChild(tr);
  });
}

function generateTableRows(tableId, indicators, table, ageGroups = null) {
  const tbody = document.getElementById(tableId);
  tbody.innerHTML = '';
  indicators.forEach((indicator, rowIndex) => {
    const tr = document.createElement('tr');
    const isSubItem = indicator.startsWith('a.') || indicator.startsWith('b.') || indicator.startsWith('c.') || indicator.startsWith('1a.') || indicator.startsWith('1b.') || indicator.startsWith('1c.') || indicator.startsWith('2a.') || indicator.startsWith('2b.') || indicator.startsWith('3a.') || indicator.startsWith('3b.') || indicator.startsWith('4a.') || indicator.startsWith('4b.') || indicator.startsWith('5a.') || indicator.startsWith('5b.') || indicator.startsWith('6a.') || indicator.startsWith('6b.');
    tr.className = 'hover:bg-gray-50';

    if (ageGroups === '3-age') {
      tr.innerHTML = `
        <td class="border border-gray-300 p-2 text-sm ${isSubItem ? 'pl-8 text-gray-700' : ''}">${indicator}</td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="0" min="0" onchange="calculateTotal('${table}', ${rowIndex})"></td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="1" min="0" onchange="calculateTotal('${table}', ${rowIndex})"></td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="2" min="0" onchange="calculateTotal('${table}', ${rowIndex})"></td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="${table}" data-row="${rowIndex}" data-col="t" readonly></td>
        <td class="border border-gray-300 p-1"><input type="text" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="r"></td>
      `;
    } else if (ageGroups === 'single') {
      tr.innerHTML = `
        <td class="border border-gray-300 p-2 text-sm ${isSubItem ? 'pl-8 text-gray-700' : ''}">${indicator}</td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="0" min="0"></td>
        <td class="border border-gray-300 p-1"><input type="text" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="r"></td>
      `;
    } else if (ageGroups === 'male-female') {
      tr.innerHTML = `
        <td class="border border-gray-300 p-2 text-sm ${isSubItem ? 'pl-8 text-gray-700' : ''}">${indicator}</td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="m" min="0" onchange="calculateTotal2Cols('${table}', ${rowIndex})"></td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="f" min="0" onchange="calculateTotal2Cols('${table}', ${rowIndex})"></td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="${table}" data-row="${rowIndex}" data-col="t" readonly></td>
        <td class="border border-gray-300 p-1"><input type="text" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="r"></td>
      `;
    } else {
      tr.innerHTML = `
        <td class="border border-gray-300 p-2 text-sm ${isSubItem ? 'pl-8 text-gray-700' : ''}">${indicator}</td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="m" min="0" onchange="calculateTotal2Cols('${table}', ${rowIndex})"></td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="f" min="0" onchange="calculateTotal2Cols('${table}', ${rowIndex})"></td>
        <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="${table}" data-row="${rowIndex}" data-col="t" readonly></td>
        <td class="border border-gray-300 p-1"><input type="text" class="cell-input" data-table="${table}" data-row="${rowIndex}" data-col="r"></td>
      `;
    }
    tbody.appendChild(tr);
  });
}

function initializeTables() {
  generateModernFPTable();
  generateTableRows('prenatal-body', prenatalIndicators, 'prenatal', '3-age');
  generateTableRows('immun-a1-body', immunA1, 'immun-a1');
  generateTableRows('immun-a2-body', immunA2, 'immun-a2');
  generateTableRows('immun-a3-body', immunA3, 'immun-a3');
  generateTableRows('immun-a4-body', immunA4, 'immun-a4');
  generateTableRows('nutrition-body', nutritionIndicators, 'nutrition');
  generateTableRows('sick-body', sickIndicators, 'sick');
  generateTableRows('oral-body', oralIndicators, 'oral');
  generateTableRows('e1-body', e1Indicators, 'e1');
  generateTableRows('e2-body', e2Indicators, 'e2');
  generateTableRows('e3-body', e3Indicators, 'e3');
  generateTableRows('e4-body', e4Indicators, 'e4');
  generateTableRows('e5-body', e5Indicators, 'e5');
  generateTableRows('e6-body', e6Indicators, 'e6', 'male-female');
  generateTableRows('e7-body', e7Indicators, 'e7', 'male-female');
  generateTableRows('e8-body', e8Indicators, 'e8');
  generateTableRows('f-water-body', waterIndicators, 'f-water', 'single');
  generateTableRows('f-sanitation-body', sanitationIndicators, 'f-sanitation', 'single');
  generateTableRows('g-filariasis-body', filariasisIndicators, 'g-filariasis');
  generateTableRows('g-rabies-body', rabiesIndicators, 'g-rabies');
  generateTableRows('g-schistosomiasis-body', schistosomiasisIndicators, 'g-schistosomiasis');
  generateTableRows('g-sth-body', sthIndicators, 'g-sth');
  generateTableRows('g-leprosy-body', leprosyIndicators, 'g-leprosy');
  generateTableRows('g-hiv-body', hivIndicators, 'g-hiv');
  generateTableRows('vital-mortality-body', mortalityIndicators, 'vital-mortality', '3-age');
  generateTableRows('vital-natality-body', natalityIndicators, 'vital-natality');
}

function collectFormData() {
  const data = {};
  document.querySelectorAll('input[data-table]').forEach(input => {
    const key = input.dataset.table + '-' + input.dataset.row + '-' + input.dataset.col;
    data[key] = input.value;
  });
  return data;
}

function loadFormData(data) {
  if (!data) return;
  Object.keys(data).forEach(key => {
    const parts = key.split('-');
    if (parts.length >= 3) {
      const lastParts = parts.slice(-2);
      const table = parts.slice(0, -2).join('-');
      const row = lastParts[0];
      const col = lastParts[1];
      const input = document.querySelector(`input[data-table="${table}"][data-row="${row}"][data-col="${col}"]`);
      if (input) input.value = data[key];
    }
  });
}

async function saveReport() {
  const formData = collectFormData();
  const reportInfo = {
    report_month: document.getElementById('fhsis-month').value,
    report_year: document.getElementById('fhsis-year').value,
    barangay_name: document.getElementById('barangay-name-field').value,
    bhs_name: document.getElementById('bhs-name-field').value,
    municipality: document.getElementById('municipality-field').value,
    province: document.getElementById('province-field').value,
    population: document.getElementById('population-field').value
  };
  const saveData = { reportInfo, formData, savedAt: new Date().toISOString() };
  showStatus('Saving report...', 'info');
  if (window.dataSdk) {
    try {
      if (allReportData.length > 0) {
        const existingRecord = allReportData[0];
        existingRecord.data = JSON.stringify(saveData);
        existingRecord.updated_at = new Date().toISOString();
        const result = await window.dataSdk.update(existingRecord);
        if (result.isOk) showStatus('Report saved successfully!', 'success');
        else showStatus('Failed to save report.', 'error');
      } else {
        const result = await window.dataSdk.create({ id: 'fhsis-report-' + Date.now(), section: 'main', data: JSON.stringify(saveData), created_at: new Date().toISOString(), updated_at: new Date().toISOString() });
        if (result.isOk) showStatus('Report saved successfully!', 'success');
        else showStatus('Failed to save report.', 'error');
      }
    } catch (e) { showStatus('Error saving report.', 'error'); }
  } else {
    localStorage.setItem('fhsis-report', JSON.stringify(saveData));
    showStatus('Report saved locally!', 'success');
  }
}

function loadSavedReport() {
  const saved = localStorage.getItem('fhsis-report');
  if (saved) {
    try {
      const data = JSON.parse(saved);
      if (data.reportInfo) {
        document.getElementById('fhsis-month').value = data.reportInfo.report_month || '';
        document.getElementById('fhsis-year').value = data.reportInfo.report_year || '';
        document.getElementById('barangay-name-field').value = data.reportInfo.barangay_name || '';
        document.getElementById('bhs-name-field').value = data.reportInfo.bhs_name || '';
        document.getElementById('municipality-field').value = data.reportInfo.municipality || '';
        document.getElementById('province-field').value = data.reportInfo.province || '';
        document.getElementById('population-field').value = data.reportInfo.population || '';
      }
      if (data.formData) loadFormData(data.formData);
    } catch (e) { console.error('Error loading saved report:', e); }
  }
}

function exportToPDF() {
  showStatus('Generating PDF...', 'info');
  const element = document.getElementById('app-wrapper');
  document.querySelectorAll('.collapsible-content')
  .forEach(el => el.classList.add('expanded'));
  const opt = { margin: 5, filename: `FHSIS_Report_${document.getElementById('fhsis-month').value}_${document.getElementById('fhsis-year').value}.pdf`, image: { type: 'jpeg', quality: 0.98 }, html2canvas: { scale: 2, useCORS: true }, jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' } };
  html2pdf().set(opt).from(element).save().then(() => { showStatus('PDF exported successfully!', 'success'); });
}

function showStatus(message, type) {
  const statusEl = document.getElementById('status-message');
  statusEl.textContent = message;
  statusEl.className = `mb-4 p-4 rounded-lg ${type === 'success' ? 'bg-green-100 text-green-800' : type === 'error' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'}`;
  statusEl.classList.remove('hidden');
  setTimeout(() => { statusEl.classList.add('hidden'); }, 3000);
}

function toggleSection(sectionId) {
  const section = document.getElementById(sectionId);
  const chevron = document.getElementById(`chevron-${sectionId}`);
  section.classList.toggle('expanded');
  chevron.classList.toggle('rotated');
}

const elementImpl = {
  defaultConfig,
  onConfigChange: async (newConfig) => {
    config = { ...defaultConfig, ...newConfig };
    if (config.report_month) document.getElementById('fhsis-month').value = config.report_month;
    if (config.report_year) document.getElementById('fhsis-year').value = config.report_year;
    if (config.barangay_name) document.getElementById('barangay-name-field').value = config.barangay_name;
    if (config.bhs_name) document.getElementById('bhs-name-field').value = config.bhs_name;
    if (config.municipality) document.getElementById('municipality-field').value = config.municipality;
    if (config.province) document.getElementById('province-field').value = config.province;
    if (config.population) document.getElementById('population-field').value = config.population;
  },
  mapToCapabilities: () => ({ recolorables: [], borderables: [], fontEditable: undefined, fontSizeable: undefined }),
  mapToEditPanelValues: (cfg) => new Map([
    ['report_month', cfg.report_month || defaultConfig.report_month],
    ['report_year', cfg.report_year || defaultConfig.report_year],
    ['barangay_name', cfg.barangay_name || defaultConfig.barangay_name],
    ['bhs_name', cfg.bhs_name || defaultConfig.bhs_name],
    ['municipality', cfg.municipality || defaultConfig.municipality],
    ['province', cfg.province || defaultConfig.province],
    ['population', cfg.population || defaultConfig.population]
  ])
};

const dataHandler = {
  onDataChanged: (data) => {
    allReportData = data;
    if (data.length > 0) {
      try {
        const savedData = JSON.parse(data[0].data);
        if (savedData.reportInfo) {
          document.getElementById('fhsis-month').value = savedData.reportInfo.report_month || '';
          document.getElementById('fhsis-year').value = savedData.reportInfo.report_year || '';
          document.getElementById('barangay-name-field').value = savedData.reportInfo.barangay_name || '';
          document.getElementById('bhs-name-field').value = savedData.reportInfo.bhs_name || '';
          document.getElementById('municipality-field').value = savedData.reportInfo.municipality || '';
          document.getElementById('province-field').value = savedData.reportInfo.province || '';
          document.getElementById('population-field').value = savedData.reportInfo.population || '';
        }
        if (savedData.formData) loadFormData(savedData.formData);
      } catch (e) { }
    }
  }
};

async function init() {
  initializeTables();
  initializeZeroValues();
  loadSavedReport();
  if (window.elementSdk) await window.elementSdk.init(elementImpl);
  if (window.dataSdk) await window.dataSdk.init(dataHandler);

  document.querySelectorAll('input[data-col="0"], input[data-col="1"], input[data-col="2"], input[data-col="m"], input[data-col="f"]').forEach(input => {
    input.dispatchEvent(new Event('change'));	
  });
}

init();

function buildFPChart() {
  const totals = sumTable("fp-cueo");
  const labels = fpMethods;
  const data = labels.map((_, i) => totals[i] || 0);

  if (fpChart) fpChart.destroy();

  fpChart = new Chart(document.getElementById('chart-fp'), {
    type: 'bar',
    data: { labels, datasets: [{ label: 'Current Users', data }] },
    options: { responsive: true }
  });

  detectHighLow(labels, data, "fp-summary");
}

function buildPrenatalChart() {
  const totals = sumTable("prenatal");

  const labels = prenatalIndicatorsModal; // use short labels
  const data = labels.map((_, i) => totals[i] || 0);

  if (prenatalChart) prenatalChart.destroy();

  prenatalChart = new Chart(document.getElementById('chart-prenatal'), {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label: 'Prenatal Totals',
        data
      }]
    },
    options: { responsive: true }
  });

  detectHighLow(labels, data, "prenatal-summary");
}

function buildImmunChart() {
  const totals = sumTable("immun-a1");
  const labels = immunA1;
  const data = labels.map((_, i) => totals[i] || 0);

  if (immunChart) immunChart.destroy();

  immunChart = new Chart(document.getElementById('chart-immun'), {
    type: 'bar',
    data: { labels, datasets: [{ label: 'Immunization Totals', data }] },
    options: { responsive: true }
  });

  detectHighLow(labels, data, "immun-summary");
}

let fpChart, prenatalChart, immunChart, nutritionChart, sickChart, oralChart, e1Chart, vitalChart;;

function buildNutritionChart() {
  const totals = sumTable("nutrition");

  const labels = nutritionIndicatorsModal.slice(0, 5); // modal labels
  const data = labels.map((_, i) => totals[i] || 0);

  if (nutritionChart) nutritionChart.destroy();

  nutritionChart = new Chart(document.getElementById('chart-nutrition'), {
    type: 'bar',
    data: {
      labels,
      datasets: [{
        label: 'Nutrition',
        data
      }]
    },
    options: { responsive: true }
  });

  detectHighLow(labels, data, "nutrition-summary");
}

function buildSickChart() {
  const totals = sumTable("sick");

  const labels = sickIndicatorsModal.slice(0, 5); // modal labels
  const data = labels.map((_, i) => totals[i] || 0);

  if (sickChart) sickChart.destroy();

  sickChart = new Chart(document.getElementById('chart-sick'), {
    type: 'bar',
    data: {
      labels,
      datasets: [{
        label: 'Sick Management',
        data
      }]
    },
    options: { responsive: true }
  });

  detectHighLow(labels, data, "sick-summary");
}

function buildOralChart() {
  const totals = sumTable("oral");

  const labels = oralIndicatorsModal.slice(0, 5); // modal labels only
  const data = labels.map((_, i) => totals[i] || 0);

  if (oralChart) oralChart.destroy();

  oralChart = new Chart(document.getElementById('chart-oral'), {
    type: 'bar',
    data: {
      labels,
      datasets: [{
        label: 'Oral Health',
        data
      }]
    },
    options: { responsive: true }
  });

  detectHighLow(labels, data, "oral-summary");
}

function buildE1Chart() {
  const totals = sumTable("e1");
  const labels = e1Indicators.slice(1, 7);
  const data = labels.map((_, i) => totals[i+1] || 0);

  if (e1Chart) e1Chart.destroy();

  e1Chart = new Chart(document.getElementById('chart-e1'), {
    type: 'radar',
    data: { labels, datasets: [{ label: 'Lifestyle Risk', data }] },
    options: { responsive: true }
  });

  detectHighLow(labels, data, "e1-summary");
}

function buildVitalChart() {
  const totals = sumTable("vital-natality");
  const labels = natalityIndicators.slice(0, 6);
  const data = labels.map((_, i) => totals[i] || 0);

  if (vitalChart) vitalChart.destroy();

  vitalChart = new Chart(document.getElementById('chart-vital'), {
    type: 'line',
    data: { labels, datasets: [{ label: 'Vital Stats', data }] },
    options: { responsive: true }
  });

  detectHighLow(labels, data, "vital-summary");
}

function toggleAnalytics() {
  const modal = document.getElementById('analytics-modal');
  modal.classList.toggle('hidden');

  if (!modal.classList.contains('hidden')) {
    setTimeout(buildAnalytics, 100);
  }
}

function sumTable(tableName) {
  let totals = {};
  document.querySelectorAll(`input[data-table="${tableName}"][data-col="t"]`)
    .forEach(input => {
      const row = input.dataset.row;
      totals[row] = parseInt(input.value) || 0;
    });
  return totals;
}

function buildAnalytics() {
  buildFPChart();
  buildPrenatalChart();
  buildImmunChart();
  buildNutritionChart();
  buildSickChart();
  buildOralChart();
  buildE1Chart();
  buildVitalChart();
}

function detectHighLow(labels, data, targetId) {
  if (!data.length) return;

  let max = Math.max(...data);
  let min = Math.min(...data);

  let maxIndex = data.indexOf(max);
  let minIndex = data.indexOf(min);

  const text = `Highest: ${labels[maxIndex]} (${max}) | Lowest: ${labels[minIndex]} (${min})`;

  document.getElementById(targetId).textContent = text;
}

function initializeZeroValues() {
  document.querySelectorAll('input[type="number"]').forEach(input => {
    if (input.value === "" || input.value == null) {
      input.value = 0;
    }
  });
}

// New added functions
function showTab(sectionId, clickedBtn) {

  // Hide all sections
  document.querySelectorAll('.tab-content').forEach(section => {
    section.style.display = 'none';
  });

  // Remove active tab
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.classList.remove('active-tab');
  });

  // Show selected section
  document.getElementById(sectionId).style.display = 'block';

  // Activate tab button
  clickedBtn.classList.add('active-tab');
}

window.addEventListener('DOMContentLoaded', () => {

  document.querySelectorAll('.tab-content').forEach(section => {
    section.style.display = 'none';
  });

  document.getElementById('section-a').style.display = 'block';

});