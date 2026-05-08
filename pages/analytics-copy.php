<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BHW | M1BRGY FHSIS Report</title>

  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  
  <script src="/_sdk/element_sdk.js"></script>
  <script src="/_sdk/data_sdk.js"></script>
  <script src="../js/tailwindAnalytics.js"></script>

  <link rel="stylesheet" href="../styles/constants/fonts.css">
  <link rel="stylesheet" href="../styles/analytics.css">
  <link rel="stylesheet" href="../styles/nav.css">
  <link rel="stylesheet" href="../styles/sidebar.css">

</head>

<body class="h-full bg-gray-50">
  <div id="app-wrapper" class="h-full w-full overflow-auto">
    <div class="max-w-full mx-auto">
      <?php include('../components/nav.html'); ?>

      <div id="status-message" class="hidden mb-4 p-4 rounded-lg"></div>

      <!-- SIDEBAR FORMS -->
      <div class="sidebar-forms">
        <div class="report-info">
          <div class="report-title">Report Information</div>

          <label for="month-year">FHSIS Report for:</label>
          <div class="month-year" id="month-year">
            <input type="text" name="month" class="month-int" placeholder="Month">
            <input type="text" name="year" class="year-int" placeholder="Year">
          </div>

          <label for="brgy-name">Name of Baranggay:</label>
          <input type="text" name="brgy-name" id="brgy-name" class="bgry-int" placeholder="Enter Name of Baranggay">

          <label for="bhs-name">Name of BHS:</label>
          <input type="text" name="bhs-name" id="bhs-name" class="bhs-int" placeholder="Enter Name of BHS">

          <label for="city-province">City and Province:</label>
          <div class="city-province" id="city-province">
            <input type="text" name="city" class="city-int" placeholder="Enter City Name">
            <input type="text" name="province" class="province-int" placeholder="Enter Province Name">
          </div>

          <label for="projected-population">Projected Population of the Year:</label>
          <input type="number" name="population" id="projected-population" class="population-int" min="0">

        </div>

        <div class="acknowledgement">
          <div class="ack-title">Acknowledgement</div>

          <label for="prepared-by">Prepared by:</label>
          <input type="text" name="prepared-by" id="prepared-by" class="prepared-int" placeholder="Enter name of person who prepared the report">

          <label for="verified-by">Verified by:</label>
          <input type="text" name="verified-by" id="verified-by" class="verified-int" placeholder="Enter name of person who verified the report">
        
          <label for="position">Position:</label>
          <input type="text" name="position" id="position" class="position-int" placeholder="Enter position">
        </div>

      </div>

      <!-- REPORT HEADER SECTION -->
      <form action="../controller/analytics.php" method="POST" id="report-form">
        <section class="bg-white rounded-xl shadow-lg mb-6 p-6">
          <h2 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Report Information</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="report-field">
              <label for="fhsis-month">FHSIS Report for the Month:</label>
              <input type="text" name="fhsis-month" id="fhsis-month" class="cell-input" placeholder="Enter month" style="width: 150px;">
            </div>
            <div class="report-field">
              <label for="fhsis-year">Year:</label>
              <input type="text" name="fhsis-year" id="fhsis-year" class="cell-input" placeholder="Enter year" style="width: 100px;">
            </div>
            <div class="report-field">
              <label for="barangay-name-field">Name of Barangay:</label>
              <input type="text" name="barangay-name" id="barangay-name-field" class="cell-input" placeholder="Enter barangay name" style="min-width: 300px;">
            </div>
            <div class="report-field">
              <label for="bhs-name-field">Name of BHS:</label>
              <input type="text" name="bhs-name" id="bhs-name-field" class="cell-input" placeholder="Enter BHS name" style="min-width: 300px;">
            </div>
            <div class="report-field">
              <label for="municipality-field">Name of Municipality/City:</label>
              <input type="text" name="municipality" id="municipality-field" class="cell-input" placeholder="Enter municipality/city" style="min-width: 300px;">
            </div>
            <div class="report-field">
              <label for="province-field">Name of Province:</label>
              <input type="text" name="province" id="province-field" class="cell-input" placeholder="Enter province" style="min-width: 300px;">
            </div>
            <div class="report-field">
              <label for="population-field">Projected Population of the Year:</label>
              <input type="number" name="population" id="population-field" class="cell-input" placeholder="Enter population" style="min-width: 200px;">
            </div>
            <div class="report-field">
              <input type="submit" name="submitReportInformation" id="submit-report" class="cell-input bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-dark transition" value="Submit">
            </div>
          </div>
        </section>
      </form>

      <div class="flex flex-wrap gap-2 mb-6 no-print">
        <button onclick="saveReport()" class="bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-dark transition flex items-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
          Save
        </button>
        <button onclick="exportToPDF()" class="bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-800 transition flex items-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          Export PDF
        </button>
        <button onclick="exportToCSV()" class="bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-800 transition flex items-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          Export CSV
        </button>
        <button onclick="toggleAnalytics()" class="bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-800 transition flex items-center gap-2">
          📊 Analytics Dashboard
        </button>
      </div>

      <!-- SECTION A -->
      <section class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
        <button onclick="toggleSection('section-a')" class="w-full bg-primary text-white p-4 flex justify-between items-center hover:bg-primary-dark transition">
          <h2 class="text-lg md:text-xl font-bold">SECTION A: Family Planning Services For Women Of Reproductive Age</h2>
          <svg id="chevron-section-a" class="w-6 h-6 chevron rotated" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="section-a" class="collapsible-content expanded section-content p-4">
          <div class="mb-8">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Table: Demand Satisfied</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Age Group 10-14</th>
                    <th class="border border-primary-dark p-2 text-center">Age Group 15-19</th>
                    <th class="border border-primary-dark p-2 text-center">Age Group 20-49</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total WRA 15-49 years old</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 p-2 text-sm">No of women of reproductive age(WRA) 15-49 years old who have demand for Family Planning(FP) and currently using, or whose partner is currently using, any modern FP Methods.</td>
                    <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="demand" data-row="0" data-col="0" min="0" onchange="calculateTotal('demand', 0)"></td>
                    <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="demand" data-row="0" data-col="1" min="0" onchange="calculateTotal('demand', 0)"></td>
                    <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="demand" data-row="0" data-col="2" min="0" onchange="calculateTotal('demand', 0)"></td>
                    <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="demand" data-row="0" data-col="t" readonly></td>
                    <td class="border border-gray-300 p-1"><input type="text" class="cell-input" data-table="demand" data-row="0" data-col="remarks"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="mb-8">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Table: Modern FP Methods</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-xs" id="modern-fp-table">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[120px]" rowspan="2">FP Methods</th>
                    <th class="border border-primary-dark p-1 text-center" colspan="4">Current Users (Beginning of Month)</th>
                    <th class="border border-primary-dark p-1 text-center" colspan="4">New Acceptors (Previous Month)</th>
                    <th class="border border-primary-dark p-1 text-center" colspan="4">Other Acceptors (Present Month)</th>
                    <th class="border border-primary-dark p-1 text-center" colspan="4">Dropouts (Present Month)</th>
                    <th class="border border-primary-dark p-1 text-center" colspan="4">Current Users (End of Month)</th>
                    <th class="border border-primary-dark p-1 text-center" colspan="4">New Acceptors (Present Month)</th>
                  </tr>
                  <tr class="bg-primary text-white text-xs">
                    <th class="border border-primary-dark p-1">10-14</th><th class="border border-primary-dark p-1">15-19</th><th class="border border-primary-dark p-1">20-49</th><th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-1">10-14</th><th class="border border-primary-dark p-1">15-19</th><th class="border border-primary-dark p-1">20-49</th><th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-1">10-14</th><th class="border border-primary-dark p-1">15-19</th><th class="border border-primary-dark p-1">20-49</th><th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-1">10-14</th><th class="border border-primary-dark p-1">15-19</th><th class="border border-primary-dark p-1">20-49</th><th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-1">10-14</th><th class="border border-primary-dark p-1">15-19</th><th class="border border-primary-dark p-1">20-49</th><th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-1">10-14</th><th class="border border-primary-dark p-1">15-19</th><th class="border border-primary-dark p-1">20-49</th><th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                  </tr>
                </thead>
                <tbody id="modern-fp-body"></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION B -->
      <section class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden print-break">
        <button onclick="toggleSection('section-b')" class="w-full bg-primary text-white p-4 flex justify-between items-center hover:bg-primary-dark transition">
          <h2 class="text-lg md:text-xl font-bold">SECTION B: MATERNAL CARE AND SERVICES</h2>
          <svg id="chevron-section-b" class="w-6 h-6 chevron rotated" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="section-b" class="collapsible-content expanded section-content p-4">
          <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Indicator: Prenatal Care Services</h3>
          <div class="table-container">
            <table class="w-full border-collapse text-sm" id="prenatal-table">
              <thead class="sticky-header">
                <tr class="bg-primary text-white">
                  <th class="border border-primary-dark p-2 text-left min-w-[400px]">Indicator</th>
                  <th class="border border-primary-dark p-2 text-center">Age Group 10-14</th>
                  <th class="border border-primary-dark p-2 text-center">Age Group 15-19</th>
                  <th class="border border-primary-dark p-2 text-center">Age Group 20-49</th>
                  <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                  <th class="border border-primary-dark p-2 text-center min-w-[200px]">Remarks</th>
                </tr>
              </thead>
              <tbody id="prenatal-body"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- SECTION C -->
      <section class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden print-break">
        <button onclick="toggleSection('section-c')" class="w-full bg-primary text-white p-4 flex justify-between items-center hover:bg-primary-dark transition">
          <h2 class="text-lg md:text-xl font-bold">SECTION C: CHILD HEALTH CARE SERVICES</h2>
          <svg id="chevron-section-c" class="w-6 h-6 chevron rotated" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="section-c" class="collapsible-content expanded section-content p-4">
          <div class="mb-8">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Indicator: IMMUNIZATION</h3>
            <div class="mb-6">
              <h4 class="text-md font-semibold text-primary mb-3 pl-2 border-l-4 border-primary">Sub-Header: A.1. Immunization</h4>
              <div class="table-container">
                <table class="w-full border-collapse text-sm">
                  <thead class="sticky-header">
                    <tr class="bg-primary text-white">
                      <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                      <th class="border border-primary-dark p-2 text-center">Sex (Male)</th>
                      <th class="border border-primary-dark p-2 text-center">Sex (Female)</th>
                      <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                      <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                    </tr>
                  </thead>
                  <tbody id="immun-a1-body"></tbody>
                </table>
              </div>
            </div>
            <div class="mb-6">
              <h4 class="text-md font-semibold text-primary mb-3 pl-2 border-l-4 border-primary">Sub-Header: A.2 Immunization Services(0-12 months old)</h4>
              <div class="table-container">
                <table class="w-full border-collapse text-sm">
                  <thead class="sticky-header">
                    <tr class="bg-primary text-white">
                      <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                      <th class="border border-primary-dark p-2 text-center">Sex (Male)</th>
                      <th class="border border-primary-dark p-2 text-center">Sex (Female)</th>
                      <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                      <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                    </tr>
                  </thead>
                  <tbody id="immun-a2-body"></tbody>
                </table>
              </div>
            </div>
            <div class="mb-6">
              <h4 class="text-md font-semibold text-primary mb-3 pl-2 border-l-4 border-primary">Sub-Header: A.3. Immunization Services(13-23 months old)</h4>
              <div class="table-container">
                <table class="w-full border-collapse text-sm">
                  <thead class="sticky-header">
                    <tr class="bg-primary text-white">
                      <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                      <th class="border border-primary-dark p-2 text-center">Sex (Male)</th>
                      <th class="border border-primary-dark p-2 text-center">Sex (Female)</th>
                      <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                      <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                    </tr>
                  </thead>
                  <tbody id="immun-a3-body"></tbody>
                </table>
              </div>
            </div>
            <div class="mb-6">
              <h4 class="text-md font-semibold text-primary mb-3 pl-2 border-l-4 border-primary">Sub-Header: A.4. School-Based Immunization</h4>
              <div class="table-container">
                <table class="w-full border-collapse text-sm">
                  <thead class="sticky-header">
                    <tr class="bg-primary text-white">
                      <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                      <th class="border border-primary-dark p-2 text-center">Sex (Male)</th>
                      <th class="border border-primary-dark p-2 text-center">Sex (Female)</th>
                      <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                      <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                    </tr>
                  </thead>
                  <tbody id="immun-a4-body"></tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="mb-8">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Indicator: NUTRITION</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[350px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Sex (Male)</th>
                    <th class="border border-primary-dark p-2 text-center">Sex (Female)</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="nutrition-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-8">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Indicator: MANAGEMENT OF SICK</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[350px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Sex (Male)</th>
                    <th class="border border-primary-dark p-2 text-center">Sex (Female)</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="sick-body"></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION D -->
      <section class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden print-break">
        <button onclick="toggleSection('section-d')" class="w-full bg-primary text-white p-4 flex justify-between items-center hover:bg-primary-dark transition">
          <h2 class="text-lg md:text-xl font-bold">SECTION D: ORAL HEALTH CARE SERVICES</h2>
          <svg id="chevron-section-d" class="w-6 h-6 chevron rotated" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="section-d" class="collapsible-content expanded section-content p-4">
          <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Oral Health Care Services</h3>
          <div class="table-container">
            <table class="w-full border-collapse text-sm">
              <thead class="sticky-header">
                <tr class="bg-primary text-white">
                  <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                  <th class="border border-primary-dark p-2 text-center">Sex (Male)</th>
                  <th class="border border-primary-dark p-2 text-center">Sex (Female)</th>
                  <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                  <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                </tr>
              </thead>
              <tbody id="oral-body"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- SECTION E -->
      <section class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden print-break">
        <button onclick="toggleSection('section-e')" class="w-full bg-primary text-white p-4 flex justify-between items-center hover:bg-primary-dark transition">
          <h2 class="text-lg md:text-xl font-bold">SECTION E: NON-COMMUNICABLE DISEASES</h2>
          <svg id="chevron-section-e" class="w-6 h-6 chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="section-e" class="collapsible-content section-content p-4">
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">INDICATOR E1: Lifestyle-Related Risk</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="e1-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">INDICATOR E2: Cardiovascular Disease Prevention and Control</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="e2-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">INDICATOR E3: Diabetes Mellitus Prevention and Control</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="e3-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">INDICATOR E4: Blindness Prevention Program</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="e4-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">INDICATOR E5: Immunization for Senior Citizens</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="e5-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">INDICATOR E6: Cervical Cancer Prevention and Control Services</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="e6-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">INDICATOR E7: Breast Cancer Prevention and Control Services</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="e7-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">INDICATOR E8: Mental Health</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="e8-body"></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION F -->
      <section class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden print-break">
        <button onclick="toggleSection('section-f')" class="w-full bg-primary text-white p-4 flex justify-between items-center hover:bg-primary-dark transition">
          <h2 class="text-lg md:text-xl font-bold">SECTION F: ENVIRONMENTAL HEALTH AND SANITATION</h2>
          <svg id="chevron-section-f" class="w-6 h-6 chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="section-f" class="collapsible-content section-content p-4">
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">G1. Water</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Count</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="f-water-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">G1. Sanitation</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Count</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="f-sanitation-body"></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION G -->
      <section class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden print-break">
        <button onclick="toggleSection('section-g')" class="w-full bg-primary text-white p-4 flex justify-between items-center hover:bg-primary-dark transition">
          <h2 class="text-lg md:text-xl font-bold">SECTION G: INFECTIOUS DISEASE PREVENTION AND CONTROL SERVICES</h2>
          <svg id="chevron-section-g" class="w-6 h-6 chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="section-g" class="collapsible-content section-content p-4">
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">A. Filariasis</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="g-filariasis-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">B. Rabies</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="g-rabies-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">C. Schistosomiasis</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="g-schistosomiasis-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">D. Soil-Transmitted Helminthiasis</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="g-sth-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">E. Leprosy</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="g-leprosy-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">F. HIV-AIDS/STI</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="g-hiv-body"></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION H: VITAL STATISTICS -->
      <section class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden print-break">
        <button onclick="toggleSection('section-vital')" class="w-full bg-primary text-white p-4 flex justify-between items-center hover:bg-primary-dark transition">
          <h2 class="text-lg md:text-xl font-bold">SECTION H: VITAL STATISTICS</h2>
          <svg id="chevron-section-vital" class="w-6 h-6 chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="section-vital" class="collapsible-content section-content p-4">
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Part I. Mortality</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Age 10-14</th>
                    <th class="border border-primary-dark p-2 text-center">Age 15-19</th>
                    <th class="border border-primary-dark p-2 text-center">Age 20-49</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="vital-mortality-body"></tbody>
              </table>
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-lg font-bold text-primary mb-4 border-b-2 border-primary pb-2">Part II. Natality</h3>
            <div class="table-container">
              <table class="w-full border-collapse text-sm">
                <thead class="sticky-header">
                  <tr class="bg-primary text-white">
                    <th class="border border-primary-dark p-2 text-left min-w-[300px]">Indicator</th>
                    <th class="border border-primary-dark p-2 text-center">Male</th>
                    <th class="border border-primary-dark p-2 text-center">Female</th>
                    <th class="border border-primary-dark p-2 text-center bg-primary-dark">Total</th>
                    <th class="border border-primary-dark p-2 text-center min-w-[150px]">Remarks</th>
                  </tr>
                </thead>
                <tbody id="vital-natality-body"></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

<!-- ANALYTICS DASHBOARD -->
<!-- ANALYTICS MODAL -->
<div id="analytics-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">

  <div class="bg-white rounded-xl shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-y-auto p-6 relative">

    <button onclick="toggleAnalytics()" class="absolute top-3 right-3 text-gray-600 hover:text-black text-xl font-bold">
      ✕
    </button>

    <h2 class="text-2xl font-bold text-blue-700 mb-6">Analytics Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <h3 class="font-semibold mb-2">Family Planning Users</h3>
        <canvas id="chart-fp"></canvas>
        <p id="fp-summary" class="mt-2 text-sm font-semibold text-gray-700"></p>
      </div>

      <div>
        <h3 class="font-semibold mb-2">Prenatal Services Totals</h3>
        <canvas id="chart-prenatal"></canvas>
        <p id="prenatal-summary" class="mt-2 text-sm font-semibold text-gray-700"></p>
      </div>

      <div class="md:col-span-2">
        <h3 class="font-semibold mb-2">Immunization Summary</h3>
        <canvas id="chart-immun"></canvas>
        <p id="immun-summary" class="mt-2 text-sm font-semibold text-gray-700"></p>
      </div>

<div>
  <h3 class="font-semibold mb-2">Nutrition Summary</h3>
  <canvas id="chart-nutrition"></canvas>
  <p id="nutrition-summary" class="mt-2 text-sm font-semibold text-gray-700"></p>
</div>

<div>
  <h3 class="font-semibold mb-2">Sick Child Management</h3>
  <canvas id="chart-sick"></canvas>
  <p id="sick-summary" class="mt-2 text-sm font-semibold text-gray-700"></p>
</div>

<div>
  <h3 class="font-semibold mb-2">Oral Health Services</h3>
  <canvas id="chart-oral"></canvas>
  <p id="oral-summary" class="mt-2 text-sm font-semibold text-gray-700"></p>
</div>

<div>
  <h3 class="font-semibold mb-2">Lifestyle Risk (NCD)</h3>
  <canvas id="chart-e1"></canvas>
  <p id="e1-summary" class="mt-2 text-sm font-semibold text-gray-700"></p>
</div>

<div class="md:col-span-2">
  <h3 class="font-semibold mb-2">Vital Statistics Overview</h3>
  <canvas id="chart-vital"></canvas>
  <p id="vital-summary" class="mt-2 text-sm font-semibold text-gray-700"></p>
</div>




    </div>
  </div>
</div>
    <footer class="bg-white rounded-xl shadow-lg p-6 no-print">
      <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-gray-600 text-sm">
          <p>Prepared by: _______________________</p>
          <p class="mt-2">Date: _______________________</p>
        </div>
        <div class="text-gray-600 text-sm text-right">
          <p>Verified by: _______________________</p>
          <p class="mt-2">Position: _______________________</p>
        </div>
      </div>
    </footer>
  </div>
</div>

<script src="../js/analytics.js"></script>
<script src="../js/downloadCSV.js"></script>

</body>
</html>