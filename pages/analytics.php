<?php
  session_start();
  require '../controller/search.php';

  $month_year_id = $_SESSION['month_year_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BHW | M1BRGY FHSIS Report</title>

  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <script src="/_sdk/element_sdk.js"></script>
  <script src="/_sdk/data_sdk.js"></script>
  <script src="../js/tailwindAnalytics.js"></script>

  <link rel="stylesheet" href="../styles/constants/fonts.css">
  <link rel="stylesheet" href="../styles/analytics.css">
  <link rel="stylesheet" href="../styles/components/nav.css">
  <link rel="stylesheet" href="../styles/analytics-sidebar.css">
  <link rel="stylesheet" href="../styles/analytics-forms.css">
  <link rel="stylesheet" href="../styles/analytics-modal.css">

</head>

<body class="h-full">
  <div id="app-wrapper" class="h-full w-full overflow-auto">
    <div class="max-w-full mx-auto">
      <?php include('../components/nav.html'); ?>
      <?php
        if (isset($_SESSION['errors'])) {
            echo "<div class='toast-container error-container'>";
            echo "<span class='toast-close' onclick='closeToast(this)'>&times;</span>";
            foreach ($_SESSION['errors'] as $error) {
                echo "<div class='error-message'>$error</div>";
            }
            echo "</div>";
            unset($_SESSION['errors']);
        }
        if (isset($_GET['success'])) {
          echo "<div class='toast-container success-container'>";
          echo "<span class='toast-close' onclick='closeToast(this)'>&times;</span>";
          echo "Successfully created " . ($_SESSION['month_year_id'] ?? '') . " data";
          echo "</div>";
        }
      ?>

      <div id="status-message" class="hidden mb-4 p-4 rounded-lg"></div>

      <form action="../controller/analytics.php" method="POST" id="report-form">
      <div class="main-body">
        <!-- SIDEBAR FORMS -->
        <?php include "../components/analytics/sidebar.php"; ?>

        <!-- BODY FORMS -->
        <?php
          if ($month_year_id) {
        ?>
        <div class="body-forms">
          <div class="btn-sections">
            <div class="search-container">
              <input type="text" id="searchInput" placeholder="Select Report Date" />

              <div class="results" id="results"></div>
            </div>

            <div class="right-buttons">
              <button class="btn-export export-csv">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-csv" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM3.517 14.841a1.13 1.13 0 0 0 .401.823q.195.162.478.252.284.091.665.091.507 0 .859-.158.354-.158.539-.44.187-.284.187-.656 0-.336-.134-.56a1 1 0 0 0-.375-.357 2 2 0 0 0-.566-.21l-.621-.144a1 1 0 0 1-.404-.176.37.37 0 0 1-.144-.299q0-.234.185-.384.188-.152.512-.152.214 0 .37.068a.6.6 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.2-.566 1.2 1.2 0 0 0-.5-.41 1.8 1.8 0 0 0-.78-.152q-.439 0-.776.15-.337.149-.527.421-.19.273-.19.639 0 .302.122.524.124.223.352.367.228.143.539.213l.618.144q.31.073.463.193a.39.39 0 0 1 .152.326.5.5 0 0 1-.085.29.56.56 0 0 1-.255.193q-.167.07-.413.07-.175 0-.32-.04a.8.8 0 0 1-.248-.115.58.58 0 0 1-.255-.384zM.806 13.693q0-.373.102-.633a.87.87 0 0 1 .302-.399.8.8 0 0 1 .475-.137q.225 0 .398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.4 1.4 0 0 0-.489-.272 1.8 1.8 0 0 0-.606-.097q-.534 0-.911.223-.375.222-.572.632-.195.41-.196.979v.498q0 .568.193.976.197.407.572.626.375.217.914.217.439 0 .785-.164t.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.8.8 0 0 1-.118.363.7.7 0 0 1-.272.25.9.9 0 0 1-.401.087.85.85 0 0 1-.478-.132.83.83 0 0 1-.299-.392 1.7 1.7 0 0 1-.102-.627zm8.239 2.238h-.953l-1.338-3.999h.917l.896 3.138h.038l.888-3.138h.879z"/>
                </svg>
                Export CSV
              </button>
              <button class="btn-export export-pdf" onclick="exportToPDF()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                  <path d="M4.603 14.087a.8.8 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.7 7.7 0 0 1 1.482-.645 20 20 0 0 0 1.062-2.227 7.3 7.3 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a11 11 0 0 0 .98 1.686 5.8 5.8 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.86.86 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.7 5.7 0 0 1-.911-.95 11.7 11.7 0 0 0-1.997.406 11.3 11.3 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.8.8 0 0 1-.58.029m1.379-1.901q-.25.115-.459.238c-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361q.016.032.026.044l.035-.012c.137-.056.355-.235.635-.572a8 8 0 0 0 .45-.606m1.64-1.33a13 13 0 0 1 1.01-.193 12 12 0 0 1-.51-.858 21 21 0 0 1-.5 1.05zm2.446.45q.226.245.435.41c.24.19.407.253.498.256a.1.1 0 0 0 .07-.015.3.3 0 0 0 .094-.125.44.44 0 0 0 .059-.2.1.1 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a4 4 0 0 0-.612-.053zM8.078 7.8a7 7 0 0 0 .2-.828q.046-.282.038-.465a.6.6 0 0 0-.032-.198.5.5 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822q.036.167.09.346z"/>
                </svg>
                Export PDF
              </button>
              <button class="btn-export generate-analytics" onclick="toggleAnalytics()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                  <path d="M4 11H2v3h2zm5-4H7v7h2zm5-5v12h-2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z"/>
                </svg>
                Generate Analytics
              </button>
              <button class="create-new" type="submit" name="createNewReportInformation">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                Create New
              </button>
            </div>
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
            <div class="section-header header-sections">
              <h2 class="text-lg md:text-xl font-bold">
                Family Planning Services For Women Of Reproductive Age
              </h2>
              <div class="flex items-right button-sections">
                <button id="btn-save-sectionA" onclick="saveSectionA()"
                  class="flex items-center gap-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400">
                  
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V13h6v8M9 3h6v4H9V3z" />
                  </svg>
                  Save Family Planning
                </button>

                <!-- Spinner shown while saving -->
                <svg id="sectionA-spinner" class="hidden animate-spin w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>

                <!-- Success / Error message -->
                <span id="sectionA-save-status" class="text-sm font-medium"></span>
              </div>
              <!-- end of save button -->
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
                    <tbody id="demand-body">
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
                        <th class="border border-primary-dark p-1">10-14</th>
                        <th class="border border-primary-dark p-1">15-19</th>
                        <th class="border border-primary-dark p-1">20-49</th>
                        <th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                        <th class="border border-primary-dark p-1">10-14</th>
                        <th class="border border-primary-dark p-1">15-19</th>
                        <th class="border border-primary-dark p-1">20-49</th>
                        <th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                        <th class="border border-primary-dark p-1">10-14</th>
                        <th class="border border-primary-dark p-1">15-19</th>
                        <th class="border border-primary-dark p-1">20-49</th>
                        <th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                        <th class="border border-primary-dark p-1">10-14</th>
                        <th class="border border-primary-dark p-1">15-19</th>
                        <th class="border border-primary-dark p-1">20-49</th>
                        <th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                        <th class="border border-primary-dark p-1">10-14</th>
                        <th class="border border-primary-dark p-1">15-19</th>
                        <th class="border border-primary-dark p-1">20-49</th>
                        <th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
                        <th class="border border-primary-dark p-1">10-14</th>
                        <th class="border border-primary-dark p-1">15-19</th>
                        <th class="border border-primary-dark p-1">20-49</th>
                        <th class="border border-primary-dark p-1 bg-primary-dark">Total</th>
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
            <div class="section-header header-sections">
              <h2 class="text-lg md:text-xl font-bold">
                Maternal Care and Services
              </h2>
              <div class="flex items-right button-sections">
                <button id="btn-save-sectionB" onclick="saveSectionB()"
                  class="flex items-center gap-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400">
                  
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V13h6v8M9 3h6v4H9V3z" />
                  </svg>
                  Save Maternal Care and Services
                </button>

                <!-- Spinner shown while saving -->
                <svg id="sectionB-spinner" class="hidden animate-spin w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>

                <!-- Success / Error message -->
                <span id="sectionB-save-status" class="text-sm font-medium"></span>
              </div>
              <!-- end of save button -->
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
            <div class="section-header header-sections">
              <h2 class="text-lg md:text-xl font-bold">
                Child Health Care Services
              </h2>
              
              <div class="flex items-right button-sections">
                <button id="btn-save-sectionC" onclick="saveSectionC()"
                  class="flex items-center gap-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400">
                  
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V13h6v8M9 3h6v4H9V3z" />
                  </svg>
                  Save Oral Health Care Services
                </button>

                <!-- Spinner shown while saving -->
                <svg id="sectionC-spinner" class="hidden animate-spin w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>

                <!-- Success / Error message -->
                <span id="sectionC-save-status" class="text-sm font-medium"></span>
              </div>
              <!-- end of save button -->
            </div>

            <div class="p-4">
              <div class="mb-8">
                <h3 class="pb-2">Indicator: IMMUNIZATION</h3>
                <div class="mb-6">
                  <h4 class="text-md mb-3 pl-2 border-l-4">Sub-Header: A.1. Immunization</h4>
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
                  <h4 class="text-md mb-3 pl-2 border-l-4">Sub-Header: A.2 Immunization Services(0-12 months old)</h4>
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
                  <h4 class="text-md mb-3 pl-2 border-l-4">Sub-Header: A.3. Immunization Services(13-23 months old)</h4>
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
                  <h4 class="text-md mb-3 pl-2 border-l-4">Sub-Header: A.4. School-Based Immunization</h4>
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
            <div class="section-header header-sections">
              <h2 class="text-lg md:text-xl font-bold">
                Oral Health Care Services
              </h2>
              
              <div class="flex items-right button-sections">
                <button id="btn-save-sectionD" onclick="saveSectionD()"
                  class="flex items-center gap-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400">
                  
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V13h6v8M9 3h6v4H9V3z" />
                  </svg>
                  Save Oral Health Care Services
                </button>

                <!-- Spinner shown while saving -->
                <svg id="sectionD-spinner" class="hidden animate-spin w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>

                <!-- Success / Error message -->
                <span id="sectionD-save-status" class="text-sm font-medium"></span>
              </div>
              <!-- end of save button -->
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
            <div class="section-header header-sections">
              <h2 class="text-lg md:text-xl font-bold">
                Non-communicable Diseases (NCDs)
              </h2>
              
              <div class="flex items-right button-sections">
                <button id="btn-save-sectionE" onclick="saveSectionE()"
                  class="flex items-center gap-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400">
                  
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V13h6v8M9 3h6v4H9V3z" />
                  </svg>
                  Save Infectious Disease Prevention and Control Services
                </button>

                <!-- Spinner shown while saving -->
                <svg id="sectionE-spinner" class="hidden animate-spin w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>

                <!-- Success / Error message -->
                <span id="sectionE-save-status" class="text-sm font-medium"></span>
              </div>
              <!-- end of save button -->
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
            <div class="section-header header-sections">
              <h2 class="text-lg md:text-xl font-bold">
                Environmental Health and Sanitation
              </h2>
              
              <div class="flex items-right button-sections">
                <button id="btn-save-sectionF" onclick="saveSectionF()"
                  class="flex items-center gap-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400">
                  <!-- Floppy-disk icon -->
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V13h6v8M9 3h6v4H9V3z" />
                  </svg>
                  Save Environmental Health and Sanitation
                </button>

                <!-- Spinner shown while saving -->
                <svg id="sectionF-spinner" class="hidden animate-spin w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>

                <!-- Success / Error message -->
                <span id="sectionF-save-status" class="text-sm font-medium"></span>
              </div>
              <!-- end of save button -->
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
            <div class="section-header header-sections">
              <h2 class="text-lg md:text-xl font-bold">
                Infectious Disease Prevention and Control Services
              </h2>
              
              <div class="flex items-right button-sections">
                <button id="btn-save-infectious" onclick="saveSectionG()"
                  class="flex items-center gap-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400">
                  <!-- Floppy-disk icon -->
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V13h6v8M9 3h6v4H9V3z" />
                  </svg>
                  Save Infectious Disease Prevention and Control Services
                </button>

                <!-- Spinner shown while saving -->
                <svg id="infectious-spinner" class="hidden animate-spin w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>

                <!-- Success / Error message -->
                <span id="infectious-save-status" class="text-sm font-medium"></span>
              </div>
              <!-- end of save button -->
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
            <div class="section-header header-sections">
              <h2 class="text-lg md:text-xl font-bold">
                Vital Statistics
              </h2>
              
              <div class="flex items-right button-sections">
                <button id="btn-save-vital" onclick="saveSectionH()"
                  class="flex items-center gap-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400">
                  
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V13h6v8M9 3h6v4H9V3z" />
                  </svg>
                  Save Vital Statistics
                </button>

                <!-- Spinner shown while saving -->
                <svg id="vital-spinner" class="hidden animate-spin w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>

                <!-- Success / Error message -->
                <span id="vital-save-status" class="text-sm font-medium"></span>
              </div>
              <!-- end of save button -->
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
        <?php } else { include "../components/analytics/search.php"; } ?>
      </div>

      <?php include "../components/analytics/confirmModal.php"; ?>
    </div>
    </form>

    <script src="../js/analytics.js"></script>
    <script src="../js/analytics-sections.js"></script>
    <script>
      function closeToast(el) {
        const toast = el.closest('.toast-container');

        toast.style.opacity = "0";
        toast.style.transform = "translateY(10px)";
        toast.style.pointerEvents = "none";

        setTimeout(() => {
            toast.remove();
        }, 300);
      }
    </script>
</body>

</html>