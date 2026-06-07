<link href="../../src/output.css" rel="stylesheet">
<?php
$month_year_id = $_SESSION['month_year_id'] ?? '';
$getData = "SELECT * FROM m1brgy_report_info 
                            WHERE month_year_id = '$month_year_id'";
$result = mysqli_query($connection, $getData);

if (isset($_SESSION['month_year_id'])) {
    
    while ($row = mysqli_fetch_array($result)) {
        $_SESSION["record_id"]=$row['id'];
?>

        <div class="sidebar-forms">
            <div class="report-info">
                <div class="report-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                    </svg>
                    Report Information
                </div>

                <label for="month-year">FHSIS Report for:</label>
                <div class="month-year" id="month-year">
                    <input type="text" name="fhsis-month" id="fhsis_month" class="bgry-int" value="<?php echo $row['report_for_month']; ?>" readonly>
                    <input type="number" name="fhsis-year" id="fhsis_year" class="year-int" value="<?php echo $row['report_year']; ?>" readonly>
                </div>

                <label for="brgy-name">Name of Baranggay:</label>
                <input type="text" name="barangay-name" id="brgy_name" class="bgry-int" value="<?php echo $row['brgy_name']; ?>" readonly>

                <label for="bhs-name">Name of BHS:</label>
                <input type="text" name="bhs-name" id="bhs_name" class="bhs-int" value="<?php echo $row['bhs_name']; ?>" readonly>

                <label for="city-province">City and Province:</label>
                <div class="city-province" id="city-province">
                <input type="text" name="municipality" id="municipality" class="city-int" value="<?php echo $row['city_name']; ?>" readonly>
                <input type="text" name="province" id="province" class="province-int" value="<?php echo $row['province_name']; ?>" readonly>
                </div>

                <label for="projected-population">Projected Population of the Year:</label>
                <input type="number" name="population" id="projected_population" class="population-int" min="0" value="<?php echo $row['projected_population_year']; ?>" readonly>
            </div>

            <div class="acknowledgement">
                <div class="ack-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                    Acknowledgement
                </div>

                <label for="prepared-by">Prepared by:</label>
                <input type="text" name="prepared-by" id="prepared_by" class="prepared-int" value="<?php echo $row['prepared_by']; ?>" readonly>

                <label for="verified-by">Verified by:</label>
                <input type="text" name="verified-by" id="verified_by" class="verified-int" value="<?php echo $row['verified_by']; ?>" readonly>
            
                <label for="position">Position:</label>
                <input type="text" name="position" id="position" class="position-int" value="<?php echo $row['position']; ?>" readonly>
            </div>
            
            <!-- <div class="create-new edit-button">Edit</div> -->
        </div>
    <?php } } else { ?>
        <div class="sidebar-forms" id="sidebar-forms">
            <div class="report-info">
                <div class="report-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                </svg>
                Report Information
            </div>

            <label for="month-year">FHSIS Report for: <span>*</span></label>
            <div class="month-year" id="month-year">
                <select id="month" name="fhsis-month" class="month-int">
                    <option value="" disabled selected>Month</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                <input type="number" name="fhsis-year" class="year-int" placeholder="Year">
            </div>

            <label for="brgy-name">Name of Baranggay: <span>*</span></label>
            <input type="text" name="barangay-name" id="brgy-name" class="bgry-int" placeholder="Enter Name of Baranggay">

            <label for="bhs-name">Name of BHS: <span>*</span></label>
            <input type="text" name="bhs-name" id="bhs-name" class="bhs-int" placeholder="Enter Name of BHS">

            <label for="city-province">City and Province: <span>*</span></label>
            <div class="city-province" id="city-province">
                <input type="text" name="municipality" class="city-int" placeholder="City">
                <input type="text" name="province" class="province-int" placeholder="Province">
            </div>

            <label for="projected-population">Projected Population of the Year: <span>*</span></label>
            <input type="number" name="population" id="projected-population" class="population-int" min="0" placeholder="0">

        </div>

        <div class="acknowledgement">
            <div class="ack-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
                Acknowledgement
            </div>

            <label for="prepared-by">Prepared by: <span>*</span></label>
            <input type="text" name="prepared-by" id="prepared-by" class="prepared-int" placeholder="Enter full name">

            <label for="verified-by">Verified by: <span>*</span></label>
            <input type="text" name="verified-by" id="verified-by" class="verified-int" placeholder="Enter full name">

            <label for="position">Position: <span>*</span></label>
            <input type="text" name="position" id="position" class="position-int" placeholder="Title or position">
        </div>

        <!-- submitReportInformation -->
        <div class="create-new" name="confirmModal"
            data-bs-toggle="modal" data-bs-target="#confirmModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
            Create New
        </div>
    </div>
<?php }
?>