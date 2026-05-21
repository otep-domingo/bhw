<!doctype html>
<html lang="en" class="h-full">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BHW | Monthly Accomplishment Report</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/_sdk/element_sdk.js"></script>
  <script src="/_sdk/data_sdk.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&amp;display=swap" rel="stylesheet">
  <style>
    body {
      box-sizing: border-box;
    }
    * {
      font-family: 'Source Sans Pro', sans-serif;
    }
    @media print {
      .no-print { display: none !important; }
      .print-break { page-break-before: always; }
      body { font-size: 10px; }
      table { font-size: 9px; }
      input { border: none !important; background: transparent !important; }
    }
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    input[type="number"] { -moz-appearance: textfield; }
    .data-cell { min-width: 45px; }
    .sticky-col { position: sticky; left: 0; z-index: 10; }
  </style>
  <style>@view-transition { navigation: auto; }</style>
 </head>
 <body class="h-full bg-gray-50">
  <div id="app" class="h-full w-full overflow-auto"><!-- Header -->
   <header class="bg-gradient-to-r from-green-700 to-green-600 text-white py-4 px-4 shadow-lg no-print">
    <div class="max-w-7xl mx-auto flex items-center justify-between flex-wrap gap-4">
     <div class="flex items-center gap-3">
      <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
       <svg class="w-8 h-8 text-green-700" fill="currentColor" viewbox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
       </svg>
      </div>
      <div>
       <h1 id="main-title" class="text-xl font-bold">Barangay Health Workers</h1>
       <p class="text-green-100 text-sm">Monthly Accomplishment Report</p>
      </div>
     </div>
     <div class="flex gap-2 flex-wrap"><button onclick="saveReport()" class="bg-white text-green-700 px-4 py-2 rounded-lg font-semibold hover:bg-green-50 transition flex items-center gap-2 text-sm">
       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
       </svg> Save </button> <button onclick="window.print()" class="bg-green-800 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-900 transition flex items-center gap-2 text-sm">
       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
       </svg> Print </button> <button onclick="exportToExcel()" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center gap-2 text-sm">
       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
       </svg> Excel </button>
     </div>
    </div>
   </header><!-- Print Header -->
   <div class="hidden print:block text-center py-4 border-b-2 border-green-700">
    <div class="flex justify-center items-center gap-4 mb-2">
     <div class="w-16 h-16 border-2 border-green-700 rounded-full flex items-center justify-center"><span class="text-xs text-green-700">LOGO</span>
     </div>
     <div>
      <h1 class="text-lg font-bold text-green-800">BARANGAY HEALTH WORKERS</h1>
      <h2 class="text-base font-semibold">MONTHLY ACCOMPLISHMENT REPORT</h2>
     </div>
    </div>
   </div>
   <main class="max-w-full mx-auto p-4"><!-- Saved Reports Selector -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-4 no-print">
     <div class="flex items-center justify-between flex-wrap gap-3">
      <div class="flex items-center gap-3 flex-wrap"><label class="font-semibold text-gray-700">Saved Reports:</label> <select id="reportSelector" onchange="loadSelectedReport()" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500"> <option value="new">+ New Report</option> </select>
      </div><button onclick="deleteCurrentReport()" id="deleteBtn" class="hidden bg-red-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-600 transition"> Delete Report </button>
     </div>
    </div><!-- Header Information -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-4 border-l-4 border-green-600">
     <h2 class="text-lg font-bold text-green-800 mb-4 flex items-center gap-2">
      <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 24 24">
       <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
      </svg> Report Information</h2>
     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <div><label class="block text-sm font-semibold text-gray-600 mb-1">Year</label> <input type="number" id="inputYear" placeholder="2024" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500" onchange="updateSummary()">
      </div>
      <div><label class="block text-sm font-semibold text-gray-600 mb-1">Name of BHW</label> <input type="text" id="inputBHW" placeholder="Enter BHW name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
      </div>
      <div><label class="block text-sm font-semibold text-gray-600 mb-1">Barangay</label> <input type="text" id="inputBarangay" placeholder="Enter barangay" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
      </div>
      <div><label class="block text-sm font-semibold text-gray-600 mb-1">Area</label> <input type="text" id="inputArea" placeholder="Enter area" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
      </div>
     </div>
    </div><!-- Main Data Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
     <div class="bg-green-700 text-white px-6 py-3">
      <h2 class="font-bold flex items-center gap-2">
       <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 24 24">
        <path d="M3 3v18h18V3H3zm16 16H5V5h14v14zM7 7h2v2H7V7zm0 4h2v2H7v-2zm0 4h2v2H7v-2zm4-8h6v2h-6V7zm0 4h6v2h-6v-2zm0 4h6v2h-6v-2z" />
       </svg> Monthly Accomplishment Data</h2>
     </div>
     <div class="overflow-x-auto">
      <table class="w-full text-sm" id="mainTable">
       <thead class="bg-green-50">
        <tr>
         <th class="sticky-col bg-green-50 text-left px-3 py-3 font-bold text-green-800 border-b-2 border-green-200 min-w-[280px]">Program / Activity</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Jan</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Feb</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Mar</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Apr</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">May</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Jun</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Jul</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Aug</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Sep</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Oct</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Nov</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 data-cell">Dec</th>
         <th class="px-2 py-3 font-bold text-green-800 border-b-2 border-green-200 bg-green-100 data-cell">Total</th>
        </tr>
       </thead>
       <tbody id="tableBody"><!-- Generated by JavaScript -->
       </tbody>
      </table>
     </div>
    </div><!-- Family Planning Methods -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-4 border-l-4 border-blue-500">
     <h2 class="text-lg font-bold text-blue-800 mb-4 flex items-center gap-2">
      <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 24 24">
       <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
      </svg> Family Planning Methods Used</h2>
     <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
       <h3 class="font-semibold text-gray-700 mb-3 pb-2 border-b">Modern Methods</h3>
       <div class="space-y-2"><label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_pills" class="w-4 h-4 text-green-600 rounded focus:ring-green-500" onchange="updateSummary()"><span>Pills (breastfeeding)</span></label> <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_injectables" class="w-4 h-4 text-green-600 rounded focus:ring-green-500" onchange="updateSummary()"><span>Injectables</span></label> <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_btl" class="w-4 h-4 text-green-600 rounded focus:ring-green-500" onchange="updateSummary()"><span>BTL (Bilateral Tubal Ligation)</span></label> <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_vasectomy" class="w-4 h-4 text-green-600 rounded focus:ring-green-500" onchange="updateSummary()"><span>Vasectomy</span></label> <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_implant" class="w-4 h-4 text-green-600 rounded focus:ring-green-500" onchange="updateSummary()"><span>Implant</span></label> <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_condom" class="w-4 h-4 text-green-600 rounded focus:ring-green-500" onchange="updateSummary()"><span>Condom</span></label>
       </div>
      </div>
      <div>
       <h3 class="font-semibold text-gray-700 mb-3 pb-2 border-b">Natural Methods</h3>
       <div class="space-y-2"><label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_cm" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" onchange="updateSummary()"><span>Cervical Mucus (CM)</span></label> <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_bbt" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" onchange="updateSummary()"><span>Basal Body Temperature (BBT)</span></label> <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_stm" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" onchange="updateSummary()"><span>Symptothermal Method (STM)</span></label> <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded"><input type="checkbox" id="fp_sdm" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" onchange="updateSummary()"><span>Standard Days Method (SDM)</span></label>
       </div>
      </div>
     </div>
    </div><!-- Summary Report -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-4 border-l-4 border-amber-500 print-break">
     <h2 class="text-lg font-bold text-amber-800 mb-4 flex items-center gap-2">
      <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 24 24">
       <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
      </svg> Summary Report</h2><!-- Category Totals -->
     <div class="mb-6">
      <h3 class="font-semibold text-gray-700 mb-3">Total Accomplishments per Category</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3" id="categoryTotals"><!-- Generated by JavaScript -->
      </div>
     </div><!-- Monthly Totals Chart -->
     <div class="mb-6">
      <h3 class="font-semibold text-gray-700 mb-3">Monthly Performance</h3>
      <div class="bg-gray-50 rounded-lg p-4">
       <div class="flex items-end justify-between gap-1 h-32" id="monthlyChart"><!-- Generated by JavaScript -->
       </div>
       <div class="flex justify-between text-xs text-gray-500 mt-2"><span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span><span>Jul</span><span>Aug</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dec</span>
       </div>
      </div>
     </div><!-- Statistics -->
     <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
      <div class="bg-green-50 rounded-lg p-4 text-center">
       <div class="text-3xl font-bold text-green-700" id="totalYear">
        0
       </div>
       <div class="text-sm text-gray-600">
        Yearly Total
       </div>
      </div>
      <div class="bg-blue-50 rounded-lg p-4 text-center">
       <div class="text-xl font-bold text-blue-700" id="highestMonth">
        -
       </div>
       <div class="text-sm text-gray-600">
        Highest Month
       </div>
      </div>
      <div class="bg-amber-50 rounded-lg p-4 text-center">
       <div class="text-xl font-bold text-amber-700" id="lowestMonth">
        -
       </div>
       <div class="text-sm text-gray-600">
        Lowest Month
       </div>
      </div>
     </div><!-- Text Summary -->
     <div class="bg-gray-50 rounded-lg p-4">
      <h3 class="font-semibold text-gray-700 mb-2">Performance Summary</h3>
      <p class="text-gray-600 text-sm leading-relaxed" id="summaryText">Enter data above to generate an automatic performance summary.</p>
     </div>
    </div><!-- Signature Section -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-4">
     <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="text-center">
       <div class="border-b-2 border-gray-400 pb-1 mb-2 mx-8"></div>
       <p class="font-semibold text-gray-700">Prepared by: BHW</p>
       <p class="text-sm text-gray-500">Date: _______________</p>
      </div>
      <div class="text-center">
       <div class="border-b-2 border-gray-400 pb-1 mb-2 mx-8"></div>
       <p class="font-semibold text-gray-700">Noted by: Midwife/PHN</p>
       <p class="text-sm text-gray-500">Date: _______________</p>
      </div>
     </div>
    </div><!-- Toast Notification -->
    <div id="toast" class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-20 opacity-0 transition-all duration-300 no-print"><span id="toastMessage">Report saved successfully!</span>
    </div>
   </main><!-- Footer -->
   <footer class="bg-green-800 text-white py-4 px-4 text-center text-sm no-print">
    <p>Barangay Health Workers Monthly Accomplishment Report System</p>
    <p class="text-green-200 text-xs mt-1">Department of Health • Republic of the Philippines</p>
   </footer>
  </div>
  <script>
    // Configuration
    const defaultConfig = {
      report_title: 'Barangay Health Workers',
      primary_color: '#15803d',
      secondary_color: '#f0fdf4',
      text_color: '#1f2937',
      accent_color: '#047857',
      surface_color: '#ffffff'
    };

    let config = { ...defaultConfig };
    let currentReportId = null;
    let allReports = [];

    // Data structure for table rows
    const tableData = [
      { category: '1. MATERNAL CARE', isHeader: true },
      { id: 'maternal_1_1', label: '1.1 Bilang ng Bagong Buntis na Nanay ngayong Buwan sa Komunidad' },
      { id: 'maternal_1_2', label: '1.2 Bilang ng Nanay na Buntis na nabigyan ng kaalaman ng Danger Sign' },
      { id: 'maternal_1_3', label: '1.3 Bilang ng Nanay na Buntis na nakipag-ugnayan sa Health Center' },
      { id: 'maternal_1_4', label: '1.4 Bilang ng Nanay na may Birth Plan' },
      { category: '2. DELIVERY', isHeader: true },
      { id: 'delivery_2_1', label: '2.1 Mga Nanay na buntis na nagsilang sa:' },
      { id: 'delivery_2_1a', label: '    a. Bahay', indent: true },
      { id: 'delivery_2_1b', label: '    b. Pasilidad', indent: true },
      { category: '3. POST-PARTUM', isHeader: true },
      { id: 'postpartum_3_1', label: '3.1 Bilang ng nanganak na Nanay na sinubaybayan para bumalik sa Health Center' },
      { category: '4. CHILDCARE', isHeader: true },
      { id: 'childcare_4_1', label: '4.1 Bilang ng mga bagong silang na sanggol na may Newborn Screening' },
      { category: '5. NATIONAL IMMUNIZATION PROGRAM', isHeader: true },
      { id: 'nip_5_1', label: '5.1 Bilang ng Bagong Panganak na Sanggol (1–28 days of life)' },
      { id: 'nip_5_2', label: '5.2 Fully Immunized Child (0–11 months)' },
      { id: 'nip_5_3', label: '5.3 Missed Child' },
      { id: 'nip_5_4', label: '5.4 Completely Immunized Child (12 months above)' },
      { category: '6. NUTRITION', isHeader: true },
      { id: 'nutrition_6_1', label: '6.1 Napurga + Micronutrient Supplementation' },
      { id: 'nutrition_6_2', label: '6.2 Buntis na nabigyan ng:' },
      { id: 'nutrition_6_2a', label: '    a. Calcium Carbonate', indent: true },
      { id: 'nutrition_6_2b', label: '    b. Iron with Folic Acid', indent: true },
      { id: 'nutrition_6_3', label: '6.3 Nagpapasusong ina na nabigyan ng:' },
      { id: 'nutrition_6_3a', label: '    a. Vitamin A', indent: true },
      { id: 'nutrition_6_3b', label: '    b. Iron with Folic Acid', indent: true },
      { id: 'nutrition_6_4', label: '6.4 Napayuhan sa wastong pagpapasuso' },
      { category: '7. FAMILY PLANNING', isHeader: true },
      { id: 'fp_7_1', label: '7.1 Operated women (BTL / hysterectomy)' },
      { id: 'fp_7_2', label: '7.2 Not using modern planning methods' },
      { id: 'fp_7_3', label: '7.3 Using modern planning methods' }
    ];

    const months = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    // Initialize table
    function initializeTable() {
      const tbody = document.getElementById('tableBody');
      tbody.innerHTML = '';

      tableData.forEach(row => {
        const tr = document.createElement('tr');
        
        if (row.isHeader) {
          tr.className = 'bg-green-100';
          tr.innerHTML = `<td colspan="14" class="sticky-col bg-green-100 px-3 py-2 font-bold text-green-800 border-b border-green-200">${row.category}</td>`;
        } else {
          tr.className = 'hover:bg-gray-50 border-b border-gray-100';
          let labelClass = row.indent ? 'pl-6' : '';
          
          let cells = `<td class="sticky-col bg-white px-3 py-2 text-gray-700 border-r border-gray-100 ${labelClass}">${row.label}</td>`;
          
          months.forEach(month => {
            cells += `<td class="px-1 py-1 text-center"><input type="number" min="0" id="${row.id}_${month}" class="w-full text-center border border-gray-200 rounded px-1 py-1 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500" value="0" onchange="updateRowTotal('${row.id}'); updateSummary()"></td>`;
          });
          
          cells += `<td class="px-2 py-2 text-center font-bold bg-green-50 text-green-800" id="${row.id}_total">0</td>`;
          tr.innerHTML = cells;
        }
        
        tbody.appendChild(tr);
      });
    }

    // Update row total
    function updateRowTotal(rowId) {
      let total = 0;
      months.forEach(month => {
        const input = document.getElementById(`${rowId}_${month}`);
        if (input) {
          total += parseInt(input.value) || 0;
        }
      });
      const totalCell = document.getElementById(`${rowId}_total`);
      if (totalCell) {
        totalCell.textContent = total;
      }
      return total;
    }

    // Update summary
    function updateSummary() {
      const categoryTotals = {};
      const monthlyTotals = {};
      let grandTotal = 0;

      months.forEach(m => monthlyTotals[m] = 0);

      // Category definitions
      const categories = {
        'Maternal Care': ['maternal_1_1', 'maternal_1_2', 'maternal_1_3', 'maternal_1_4'],
        'Delivery': ['delivery_2_1a', 'delivery_2_1b'],
        'Post-Partum': ['postpartum_3_1'],
        'Childcare': ['childcare_4_1'],
        'Immunization': ['nip_5_1', 'nip_5_2', 'nip_5_3', 'nip_5_4'],
        'Nutrition': ['nutrition_6_1', 'nutrition_6_2a', 'nutrition_6_2b', 'nutrition_6_3a', 'nutrition_6_3b', 'nutrition_6_4'],
        'Family Planning': ['fp_7_1', 'fp_7_2', 'fp_7_3']
      };

      Object.keys(categories).forEach(cat => {
        categoryTotals[cat] = 0;
        categories[cat].forEach(rowId => {
          months.forEach(month => {
            const input = document.getElementById(`${rowId}_${month}`);
            if (input) {
              const val = parseInt(input.value) || 0;
              categoryTotals[cat] += val;
              monthlyTotals[month] += val;
              grandTotal += val;
            }
          });
        });
      });

      // Update category totals display
      const categoryContainer = document.getElementById('categoryTotals');
      categoryContainer.innerHTML = '';
      const colors = ['green', 'blue', 'purple', 'amber', 'rose', 'cyan', 'orange'];
      let colorIndex = 0;
      
      Object.entries(categoryTotals).forEach(([cat, total]) => {
        const color = colors[colorIndex % colors.length];
        const div = document.createElement('div');
        div.className = `bg-${color}-50 rounded-lg p-3 border-l-4 border-${color}-500`;
        div.innerHTML = `<div class="text-lg font-bold text-${color}-700">${total}</div><div class="text-xs text-gray-600">${cat}</div>`;
        categoryContainer.appendChild(div);
        colorIndex++;
      });

      // Update monthly chart
      const chartContainer = document.getElementById('monthlyChart');
      chartContainer.innerHTML = '';
      const maxMonthly = Math.max(...Object.values(monthlyTotals), 1);
      
      months.forEach(month => {
        const val = monthlyTotals[month];
        const height = (val / maxMonthly) * 100;
        const bar = document.createElement('div');
        bar.className = 'flex-1 bg-green-500 rounded-t transition-all duration-300 hover:bg-green-600 relative group';
        bar.style.height = `${Math.max(height, 2)}%`;
        bar.innerHTML = `<div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">${val}</div>`;
        chartContainer.appendChild(bar);
      });

      // Update statistics
      document.getElementById('totalYear').textContent = grandTotal;

      // Find highest and lowest months
      let highest = { month: '', value: -1 };
      let lowest = { month: '', value: Infinity };
      
      months.forEach((month, index) => {
        if (monthlyTotals[month] > highest.value) {
          highest = { month: monthNames[index], value: monthlyTotals[month] };
        }
        if (monthlyTotals[month] < lowest.value) {
          lowest = { month: monthNames[index], value: monthlyTotals[month] };
        }
      });

      document.getElementById('highestMonth').textContent = `${highest.month} (${highest.value})`;
      document.getElementById('lowestMonth').textContent = `${lowest.month} (${lowest.value})`;

      // Generate text summary
      const year = document.getElementById('inputYear').value || 'the year';
      const bhwName = document.getElementById('inputBHW').value || 'the BHW';
      const barangay = document.getElementById('inputBarangay').value || 'the barangay';
      
      let summaryText = `For ${year}, ${bhwName} from ${barangay} has recorded a total of ${grandTotal} accomplishments across all health programs. `;
      
      if (grandTotal > 0) {
        const topCategory = Object.entries(categoryTotals).sort((a, b) => b[1] - a[1])[0];
        summaryText += `The highest performing category is ${topCategory[0]} with ${topCategory[1]} total activities. `;
        summaryText += `Performance peaked in ${highest.month} with ${highest.value} accomplishments, while ${lowest.month} recorded the lowest with ${lowest.value} activities. `;
        
        // Family planning methods summary
        const modernMethods = [];
        const naturalMethods = [];
        if (document.getElementById('fp_pills').checked) modernMethods.push('Pills');
        if (document.getElementById('fp_injectables').checked) modernMethods.push('Injectables');
        if (document.getElementById('fp_btl').checked) modernMethods.push('BTL');
        if (document.getElementById('fp_vasectomy').checked) modernMethods.push('Vasectomy');
        if (document.getElementById('fp_implant').checked) modernMethods.push('Implant');
        if (document.getElementById('fp_condom').checked) modernMethods.push('Condom');
        if (document.getElementById('fp_cm').checked) naturalMethods.push('CM');
        if (document.getElementById('fp_bbt').checked) naturalMethods.push('BBT');
        if (document.getElementById('fp_stm').checked) naturalMethods.push('STM');
        if (document.getElementById('fp_sdm').checked) naturalMethods.push('SDM');
        
        if (modernMethods.length > 0 || naturalMethods.length > 0) {
          summaryText += `Family planning methods utilized include: `;
          if (modernMethods.length > 0) summaryText += `Modern (${modernMethods.join(', ')})`;
          if (modernMethods.length > 0 && naturalMethods.length > 0) summaryText += ` and `;
          if (naturalMethods.length > 0) summaryText += `Natural (${naturalMethods.join(', ')})`;
          summaryText += `. `;
        }
      } else {
        summaryText += 'No data has been entered yet. Please fill in the monthly accomplishment data above.';
      }
      
      document.getElementById('summaryText').textContent = summaryText;
    }

    // Collect all data
    function collectData() {
      const data = {
        header: {
          year: document.getElementById('inputYear').value,
          bhw_name: document.getElementById('inputBHW').value,
          barangay: document.getElementById('inputBarangay').value,
          area: document.getElementById('inputArea').value
        },
        tableValues: {},
        familyPlanning: {
          pills: document.getElementById('fp_pills').checked,
          injectables: document.getElementById('fp_injectables').checked,
          btl: document.getElementById('fp_btl').checked,
          vasectomy: document.getElementById('fp_vasectomy').checked,
          implant: document.getElementById('fp_implant').checked,
          condom: document.getElementById('fp_condom').checked,
          cm: document.getElementById('fp_cm').checked,
          bbt: document.getElementById('fp_bbt').checked,
          stm: document.getElementById('fp_stm').checked,
          sdm: document.getElementById('fp_sdm').checked
        }
      };

      tableData.forEach(row => {
        if (!row.isHeader && row.id) {
          data.tableValues[row.id] = {};
          months.forEach(month => {
            const input = document.getElementById(`${row.id}_${month}`);
            if (input) {
              data.tableValues[row.id][month] = parseInt(input.value) || 0;
            }
          });
        }
      });

      return data;
    }

    // Load data into form
    function loadData(data) {
      if (!data) return;

      if (data.header) {
        document.getElementById('inputYear').value = data.header.year || '';
        document.getElementById('inputBHW').value = data.header.bhw_name || '';
        document.getElementById('inputBarangay').value = data.header.barangay || '';
        document.getElementById('inputArea').value = data.header.area || '';
      }

      if (data.tableValues) {
        Object.keys(data.tableValues).forEach(rowId => {
          months.forEach(month => {
            const input = document.getElementById(`${rowId}_${month}`);
            if (input && data.tableValues[rowId][month] !== undefined) {
              input.value = data.tableValues[rowId][month];
            }
          });
          updateRowTotal(rowId);
        });
      }

      if (data.familyPlanning) {
        document.getElementById('fp_pills').checked = data.familyPlanning.pills || false;
        document.getElementById('fp_injectables').checked = data.familyPlanning.injectables || false;
        document.getElementById('fp_btl').checked = data.familyPlanning.btl || false;
        document.getElementById('fp_vasectomy').checked = data.familyPlanning.vasectomy || false;
        document.getElementById('fp_implant').checked = data.familyPlanning.implant || false;
        document.getElementById('fp_condom').checked = data.familyPlanning.condom || false;
        document.getElementById('fp_cm').checked = data.familyPlanning.cm || false;
        document.getElementById('fp_bbt').checked = data.familyPlanning.bbt || false;
        document.getElementById('fp_stm').checked = data.familyPlanning.stm || false;
        document.getElementById('fp_sdm').checked = data.familyPlanning.sdm || false;
      }

      updateSummary();
    }

    // Clear form
    function clearForm() {
      document.getElementById('inputYear').value = '';
      document.getElementById('inputBHW').value = '';
      document.getElementById('inputBarangay').value = '';
      document.getElementById('inputArea').value = '';

      tableData.forEach(row => {
        if (!row.isHeader && row.id) {
          months.forEach(month => {
            const input = document.getElementById(`${row.id}_${month}`);
            if (input) input.value = 0;
          });
          updateRowTotal(row.id);
        }
      });

      document.getElementById('fp_pills').checked = false;
      document.getElementById('fp_injectables').checked = false;
      document.getElementById('fp_btl').checked = false;
      document.getElementById('fp_vasectomy').checked = false;
      document.getElementById('fp_implant').checked = false;
      document.getElementById('fp_condom').checked = false;
      document.getElementById('fp_cm').checked = false;
      document.getElementById('fp_bbt').checked = false;
      document.getElementById('fp_stm').checked = false;
      document.getElementById('fp_sdm').checked = false;

      updateSummary();
    }

    // Show toast notification
    function showToast(message) {
      const toast = document.getElementById('toast');
      const toastMessage = document.getElementById('toastMessage');
      toastMessage.textContent = message;
      toast.classList.remove('translate-y-20', 'opacity-0');
      setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0');
      }, 3000);
    }

    // Update report selector
    function updateReportSelector() {
      const selector = document.getElementById('reportSelector');
      const currentValue = selector.value;
      
      selector.innerHTML = '<option value="new">+ New Report</option>';
      
      allReports.forEach(report => {
        const option = document.createElement('option');
        option.value = report.__backendId;
        const label = `${report.bhw_name || 'Unnamed'} - ${report.year || 'No Year'} (${report.barangay || 'No Barangay'})`;
        option.textContent = label;
        selector.appendChild(option);
      });

      if (currentReportId) {
        selector.value = currentReportId;
      }

      document.getElementById('deleteBtn').classList.toggle('hidden', !currentReportId);
    }

    // Load selected report
    function loadSelectedReport() {
      const selector = document.getElementById('reportSelector');
      const selectedId = selector.value;

      if (selectedId === 'new') {
        currentReportId = null;
        clearForm();
        document.getElementById('deleteBtn').classList.add('hidden');
        return;
      }

      const report = allReports.find(r => r.__backendId === selectedId);
      if (report) {
        currentReportId = report.__backendId;
        try {
          const data = JSON.parse(report.data || '{}');
          loadData(data);
        } catch (e) {
          console.error('Error parsing report data:', e);
        }
        document.getElementById('deleteBtn').classList.remove('hidden');
      }
    }

    // Save report
    async function saveReport() {
      if (!window.dataSdk) {
        showToast('Data storage not available');
        return;
      }

      if (allReports.length >= 999 && !currentReportId) {
        showToast('Maximum limit of 999 reports reached. Please delete some reports first.');
        return;
      }

      const formData = collectData();
      const now = new Date().toISOString();

      if (currentReportId) {
        const existingReport = allReports.find(r => r.__backendId === currentReportId);
        if (existingReport) {
          const updatedReport = {
            ...existingReport,
            year: formData.header.year,
            bhw_name: formData.header.bhw_name,
            barangay: formData.header.barangay,
            area: formData.header.area,
            data: JSON.stringify(formData),
            updated_at: now
          };
          const result = await window.dataSdk.update(updatedReport);
          if (result.isOk) {
            showToast('Report updated successfully!');
          } else {
            showToast('Failed to update report');
          }
        }
      } else {
        const newReport = {
          report_id: 'RPT_' + Date.now(),
          year: formData.header.year,
          bhw_name: formData.header.bhw_name,
          barangay: formData.header.barangay,
          area: formData.header.area,
          data: JSON.stringify(formData),
          created_at: now,
          updated_at: now
        };
        const result = await window.dataSdk.create(newReport);
        if (result.isOk) {
          showToast('Report saved successfully!');
        } else {
          showToast('Failed to save report');
        }
      }
    }

    // Delete current report
    async function deleteCurrentReport() {
      if (!currentReportId || !window.dataSdk) return;

      const report = allReports.find(r => r.__backendId === currentReportId);
      if (!report) return;

      // Replace delete button with confirmation
      const deleteBtn = document.getElementById('deleteBtn');
      const originalHTML = deleteBtn.innerHTML;
      deleteBtn.innerHTML = 'Confirm Delete?';
      deleteBtn.classList.add('bg-red-700');
      
      const confirmHandler = async () => {
        const result = await window.dataSdk.delete(report);
        if (result.isOk) {
          currentReportId = null;
          clearForm();
          showToast('Report deleted successfully!');
        } else {
          showToast('Failed to delete report');
        }
        deleteBtn.innerHTML = originalHTML;
        deleteBtn.classList.remove('bg-red-700');
        deleteBtn.removeEventListener('click', confirmHandler);
        deleteBtn.addEventListener('click', deleteCurrentReport);
      };

      deleteBtn.removeEventListener('click', deleteCurrentReport);
      deleteBtn.addEventListener('click', confirmHandler);

      // Reset after 3 seconds if not confirmed
      setTimeout(() => {
        if (deleteBtn.innerHTML === 'Confirm Delete?') {
          deleteBtn.innerHTML = originalHTML;
          deleteBtn.classList.remove('bg-red-700');
          deleteBtn.removeEventListener('click', confirmHandler);
          deleteBtn.addEventListener('click', deleteCurrentReport);
        }
      }, 3000);
    }

    // Export to Excel (CSV format)
    function exportToExcel() {
      const formData = collectData();
      let csv = 'BHW Monthly Accomplishment Report\n';
      csv += `Year,${formData.header.year}\n`;
      csv += `BHW Name,${formData.header.bhw_name}\n`;
      csv += `Barangay,${formData.header.barangay}\n`;
      csv += `Area,${formData.header.area}\n\n`;
      csv += 'Program/Activity,Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Total\n';

      tableData.forEach(row => {
        if (row.isHeader) {
          csv += `"${row.category}",,,,,,,,,,,,,\n`;
        } else if (row.id) {
          let rowTotal = 0;
          let rowCsv = `"${row.label.trim()}"`;
          months.forEach(month => {
            const val = formData.tableValues[row.id]?.[month] || 0;
            rowCsv += `,${val}`;
            rowTotal += val;
          });
          rowCsv += `,${rowTotal}\n`;
          csv += rowCsv;
        }
      });

      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const link = document.createElement('a');
      const url = URL.createObjectURL(blob);
      link.setAttribute('href', url);
      link.setAttribute('download', `BHW_Report_${formData.header.year || 'export'}.csv`);
      link.style.visibility = 'hidden';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      showToast('Excel file exported!');
    }

    // Data handler for SDK
    const dataHandler = {
      onDataChanged(data) {
        allReports = data || [];
        updateReportSelector();
      }
    };

    // Initialize Element SDK
    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange: async (newConfig) => {
          config = { ...defaultConfig, ...newConfig };
          document.getElementById('main-title').textContent = config.report_title || defaultConfig.report_title;
        },
        mapToCapabilities: (config) => ({
          recolorables: [
            {
              get: () => config.primary_color || defaultConfig.primary_color,
              set: (value) => window.elementSdk.setConfig({ primary_color: value })
            },
            {
              get: () => config.secondary_color || defaultConfig.secondary_color,
              set: (value) => window.elementSdk.setConfig({ secondary_color: value })
            },
            {
              get: () => config.text_color || defaultConfig.text_color,
              set: (value) => window.elementSdk.setConfig({ text_color: value })
            },
            {
              get: () => config.accent_color || defaultConfig.accent_color,
              set: (value) => window.elementSdk.setConfig({ accent_color: value })
            },
            {
              get: () => config.surface_color || defaultConfig.surface_color,
              set: (value) => window.elementSdk.setConfig({ surface_color: value })
            }
          ],
          borderables: [],
          fontEditable: undefined,
          fontSizeable: undefined
        }),
        mapToEditPanelValues: (config) => new Map([
          ['report_title', config.report_title || defaultConfig.report_title]
        ])
      });
    }

    // Initialize Data SDK
    async function initDataSdk() {
      if (window.dataSdk) {
        const result = await window.dataSdk.init(dataHandler);
        if (!result.isOk) {
          console.error('Failed to initialize data SDK');
        }
      }
    }

    // Initialize app
    initializeTable();
    updateSummary();
    initDataSdk();
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9cb1d0f515a75ea6',t:'MTc3MDYyMzg1MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>