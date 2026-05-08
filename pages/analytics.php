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
  <link rel="stylesheet" href="../styles/components/nav.css">
  <link rel="stylesheet" href="../styles/analytics-sidebar.css">
  <link rel="stylesheet" href="../styles/analytics-forms.css">

</head>

<body class="h-full">
  <div id="app-wrapper" class="h-full w-full overflow-auto">
    <div class="max-w-full mx-auto">
      <?php include('../components/nav.html'); ?>

      <div id="status-message" class="hidden mb-4 p-4 rounded-lg"></div>

      <form action="../controller/analytics.php" method="POST" id="report-form">
        <div class="main-body">
          <!-- SIDEBAR FORMS -->
          <div class="sidebar-forms">
            <div class="report-info">
              <div class="report-title">Report Information</div>

              <label for="month-year">FHSIS Report for:</label>
              <div class="month-year" id="month-year">
                <input type="text" name="fhsis-month" class="month-int" placeholder="Month">
                <input type="text" name="fhsis-year" class="year-int" placeholder="Year">
              </div>

              <label for="brgy-name">Name of Baranggay:</label>
              <input type="text" name="barangay-name" id="brgy-name" class="bgry-int" placeholder="Enter Name of Baranggay">

              <label for="bhs-name">Name of BHS:</label>
              <input type="text" name="bhs-name" id="bhs-name" class="bhs-int" placeholder="Enter Name of BHS">

              <label for="city-province">City and Province:</label>
              <div class="city-province" id="city-province">
                <input type="text" name="municipality" class="city-int" placeholder="Enter City Name">
                <input type="text" name="province" class="province-int" placeholder="Enter Province Name">
              </div>

              <label for="projected-population">Projected Population of the Year:</label>
              <input type="number" name="population" id="projected-population" class="population-int" min="0" placeholder="0">

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

          <div class="body-forms">
            <div class="btn-sections">
              <button class="btn-export export-csv">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                Export CSV
              </button>
              <button class="btn-export export-pdf" onclick="exportToPDF()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export PDF
              </button>
              <button class="btn-export generate-analytics" onclick="toggleAnalytics()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Generate Analytics
              </button>
              <button class="btn-export submit-report" type="submit" name="submitReportInformation">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Submit Report
              </button>
            </div>

            <!-- TAB NAVIGATION -->
            <div class="navigation-breadcrumbs">
              <div class="flex flex-wrap">
                <div class="tab-btn active-tab" onclick="showTab('section-a', this)">
                  Section A
                </div>

                <div class="tab-btn" onclick="showTab('section-b', this)">
                  Section B
                </div>

                <div class="tab-btn" onclick="showTab('section-c', this)">
                  Section C
                </div>

                <div class="tab-btn" onclick="showTab('section-d', this)">
                  Section D
                </div>

                <div class="tab-btn" onclick="showTab('section-e', this)">
                  Section E
                </div>

                <div class="tab-btn" onclick="showTab('section-f', this)">
                  Section F
                </div>

                <div class="tab-btn" onclick="showTab('section-g', this)">
                  Section G
                </div>

                <div class="tab-btn" onclick="showTab('section-vital', this)">
                  Section H
                </div>

              </div>
            </div>

            <!-- SECTION A -->
            <section id="section-a" class="tab-content bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
              <!-- SECTION HEADER -->
              <div class="section-header p-4">
                <h2 class="text-lg md:text-xl font-bold">
                  Family Planning Services For Women Of Reproductive Age
                </h2>
              </div>
              <div class="p-4">
                <div class="mb-8">
                  <h3 class="pb-2">Table: Demand Satisfied</h3>
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
                          <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="demand" data-row="0" data-col="0" min="0" onchange="calculateTotal('demand', 0)" name="demand[0][0]"></td>
                          <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="demand" data-row="0" data-col="1" min="0" onchange="calculateTotal('demand', 0)" name="demand[0][1]"></td>
                          <td class="border border-gray-300 p-1"><input type="number" class="cell-input" data-table="demand" data-row="0" data-col="2" min="0" onchange="calculateTotal('demand', 0)" name="demand[0][2]"></td>
                          <td class="border border-gray-300 p-1"><input type="number" class="cell-input total-cell" data-table="demand" data-row="0" data-col="t" readonly name="demand[0][3]"></td>
                          <td class="border border-gray-300 p-1"><input type="text" class="cell-input" data-table="demand" data-row="0" data-col="remarks" name="demand[0][4]"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="mb-8">
                  <h3 class="pb-2">Table: Modern FP Methods</h3>
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
            <section id="section-b" class="tab-content bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
                <div class="section-header p-4">
                  <h2 class="text-lg md:text-xl font-bold">
                    Maternal Care and Services
                  </h2>
                </div>

                <div class="p-4">
                  <h3 class="pb-2">Indicator: Prenatal Care Services</h3>
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
            <section id="section-c" class="tab-content bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
              <div class="section-header p-4">
                <h2 class="text-lg md:text-xl font-bold">
                  Child Health Care Services
                </h2>
              </div>

              <div class="p-4">
                <div class="mb-8">
                  <h3 class="pb-2">Indicator: IMMUNIZATION</h3>
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
                  <h3 class="pb-2">Indicator: NUTRITION</h3>
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
                  <h3 class="pb-2">Indicator: MANAGEMENT OF SICK</h3>
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
            <section id="section-d" class="tab-content bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
              <div class="section-header p-4">
                <h2 class="text-lg md:text-xl font-bold">
                  Oral Health Care Services
                </h2>
              </div>

              <div class="p-4">
                <h3 class="pb-2">Oral Health Care Services</h3>
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
            <section id="section-e" class="tab-content bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
              <div class="section-header p-4">
                <h2 class="text-lg md:text-xl font-bold">
                  Non-communicable Diseases (NCDs)
                </h2>
              </div>
              <div class="p-4">
                <div class="mb-6">
                  <h3 class="pb-2">INDICATOR E1: Lifestyle-Related Risk</h3>
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
                  <h3 class="pb-2">INDICATOR E2: Cardiovascular Disease Prevention and Control</h3>
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
                  <h3 class="pb-2">INDICATOR E3: Diabetes Mellitus Prevention and Control</h3>
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
                  <h3 class="pb-2">INDICATOR E4: Blindness Prevention Program</h3>
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
                  <h3 class="pb-2">INDICATOR E5: Immunization for Senior Citizens</h3>
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
                  <h3 class="pb-2">INDICATOR E6: Cervical Cancer Prevention and Control Services</h3>
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
                  <h3 class="pb-2">INDICATOR E7: Breast Cancer Prevention and Control Services</h3>
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
                  <h3 class="pb-2">INDICATOR E8: Mental Health</h3>
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
            <section id="section-f" class="tab-content bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
              <div class="section-header p-4">
                <h2 class="text-lg md:text-xl font-bold">
                  Environmental Health and Sanitation
                </h2>
              </div>
              
              <div class="p-4">
                <div class="mb-6">
                  <h3 class="pb-2">G1. Water</h3>
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
                  <h3 class="pb-2">G1. Sanitation</h3>
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
            <section id="section-g" class="tab-content bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
              <div class="section-header p-4">
                <h2 class="text-lg md:text-xl font-bold">
                  Infectious Disease Prevention and Control Services
                </h2>
              </div>

              <div class="p-4">
                <div class="mb-6">
                  <h3 class="pb-2">A. Filariasis</h3>
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
                  <h3 class="pb-2">B. Rabies</h3>
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
                  <h3 class="pb-2">C. Schistosomiasis</h3>
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
                  <h3 class="pb-2">D. Soil-Transmitted Helminthiasis</h3>
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
                  <h3 class="pb-2">E. Leprosy</h3>
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
                  <h3 class="pb-2">F. HIV-AIDS/STI</h3>
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
            <section id="section-vital" class="tab-content bg-white rounded-xl shadow-lg mb-6 overflow-hidden print-break">
              <div class="section-header p-4">
                <h2 class="text-lg md:text-xl font-bold">
                  Vital Statistics
                </h2>
              </div>

              <div class="p-4">
                <div class="mb-6">
                  <h3 class="pb-2">
                    Part I. Mortality
                  </h3>

                  <div class="table-container">

                    <table class="w-full border-collapse text-sm">

                      <thead class="sticky-header">
                        <tr class="bg-primary text-white">

                          <th class="border border-primary-dark p-2 text-left min-w-[300px]">
                            Indicator
                          </th>

                          <th class="border border-primary-dark p-2 text-center">
                            Age 10-14
                          </th>

                          <th class="border border-primary-dark p-2 text-center">
                            Age 15-19
                          </th>

                          <th class="border border-primary-dark p-2 text-center">
                            Age 20-49
                          </th>

                          <th class="border border-primary-dark p-2 text-center bg-primary-dark">
                            Total
                          </th>

                          <th class="border border-primary-dark p-2 text-center min-w-[150px]">
                            Remarks
                          </th>

                        </tr>
                      </thead>

                      <tbody id="vital-mortality-body"></tbody>

                    </table>

                  </div>
                </div>

                <div class="mb-6">
                  <h3 class="pb-2">
                    Part II. Natality
                  </h3>

                  <div class="table-container">

                    <table class="w-full border-collapse text-sm">

                      <thead class="sticky-header">
                        <tr class="bg-primary text-white">

                          <th class="border border-primary-dark p-2 text-left min-w-[300px]">
                            Indicator
                          </th>

                          <th class="border border-primary-dark p-2 text-center">
                            Male
                          </th>

                          <th class="border border-primary-dark p-2 text-center">
                            Female
                          </th>

                          <th class="border border-primary-dark p-2 text-center bg-primary-dark">
                            Total
                          </th>

                          <th class="border border-primary-dark p-2 text-center min-w-[150px]">
                            Remarks
                          </th>

                        </tr>
                      </thead>

                      <tbody id="vital-natality-body"></tbody>

                    </table>

                  </div>

                </div>
              </div>
            </section>
            
            </div>
          </div>
        </div>
      </form>

  <script src="../js/analytics.js"></script>
</body>
</html>