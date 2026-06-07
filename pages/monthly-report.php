<!doctype html>
<html lang="en" class="h-full">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BHW | Monthly Accomplishment Report</title>
  <!--<script src="https://cdn.tailwindcss.com"></script>-->
  <link href="../src/output.css" rel="stylesheet">
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
      .no-print {
        display: none !important;
      }

      .print-break {
        page-break-before: always;
      }

      body {
        font-size: 10px;
      }

      table {
        font-size: 9px;
      }

      input {
        border: none !important;
        background: transparent !important;
      }
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    input[type="number"] {
      -moz-appearance: textfield;
    }

    .data-cell {
      min-width: 45px;
    }

    .sticky-col {
      position: sticky;
      left: 0;
      z-index: 10;
    }
  </style>
  <style>
    @view-transition {
      navigation: auto;
    }
  </style>
</head>

<body class="h-full bg-gray-50">
  <div id="app" class="h-full w-full overflow-auto"><!-- Header -->
    <header class="bg-gradient-to-r from-green-700 to-green-600 text-white py-4 px-4 shadow-lg no-print">
      <div class="max-w-7xl mx-auto flex items-center justify-between flex-wrap gap-4">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
            <svg class="w-8 h-8 text-green-700" fill="currentColor" viewbox="0 0 24 24">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
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
          <div class="flex items-center gap-3 flex-wrap"><label class="font-semibold text-gray-700">Saved Reports:</label> <select id="reportSelector" onchange="loadSelectedReport()" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
              <option value="new">+ New Report</option>
            </select>
            <input type="hidden" id="selectedReportOption" name="hiddenSelectedReport" value="">
          </div><button onclick="deleteCurrentReport()" id="deleteBtn" class="hidden bg-red-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-600 transition"> Delete Report </button>
        </div>
      </div><!-- Header Information -->
      <div class="bg-white rounded-xl shadow-md p-6 mb-4 border-l-4 border-green-600">
        <h2 class="text-lg font-bold text-green-800 mb-4 flex items-center gap-2">
          <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 24 24">
            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
          </svg> Report Information
        </h2>
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
            </svg> Monthly Accomplishment Data
          </h2>
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
          </svg> Family Planning Methods Used
        </h2>
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
          </svg> Summary Report
        </h2><!-- Category Totals -->
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
      <!-- <div id="toast" class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-20 opacity-0 transition-all duration-300 no-print"><span id="toastMessage">Report saved successfully!</span>
      </div>-->

      <!-- Modal Notification -->
      <div id="toast" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300 no-print">
        <div class="bg-white rounded-xl shadow-xl p-6 size-24  min-h-48 mx-4 transform scale-95 transition-transform duration-300" id="toastBox">
          <div class="flex items-start gap-3 mb-4">
            <div class="bg-green-100 rounded-full p-2 shrink-0 mt-0.5">
              <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <p id="toastMessage" class="text-gray-800 text-sm leading-relaxed max-h-60 overflow-y-auto">Report saved successfully!</p>
          </div>
          <div class="flex justify-end">
            <button onclick="closeToast()" class="w-full bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 rounded-lg transition-colors">
              OK
            </button>
          </div>
        </div>
      </div>
    </main><!-- Footer -->
    <footer class="bg-green-800 text-white py-4 px-4 text-center text-sm no-print">
      <p>Barangay Health Workers Monthly Accomplishment Report System</p>
      <p class="text-green-200 text-xs mt-1">Department of Health • Republic of the Philippines</p>
    </footer>
  </div>
  <script src="../js/monthlyReports.js"></script>
  <script>
    (function() {
      function c() {
        var b = a.contentDocument || a.contentWindow.document;
        if (b) {
          var d = b.createElement('script');
          d.innerHTML = "window.__CF$cv$params={r:'9cb1d0f515a75ea6',t:'MTc3MDYyMzg1MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
          b.getElementsByTagName('head')[0].appendChild(d)
        }
      }
      if (document.body) {
        var a = document.createElement('iframe');
        a.height = 1;
        a.width = 1;
        a.style.position = 'absolute';
        a.style.top = 0;
        a.style.left = 0;
        a.style.border = 'none';
        a.style.visibility = 'hidden';
        document.body.appendChild(a);
        if ('loading' !== document.readyState) c();
        else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
        else {
          var e = document.onreadystatechange || function() {};
          document.onreadystatechange = function(b) {
            e(b);
            'loading' !== document.readyState && (document.onreadystatechange = e, c())
          }
        }
      }
    })();
  </script>
</body>

</html>