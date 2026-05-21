<div class="outer-container">
    <div class="inner-container">
    <div class="title-selection">Let's get started!</div>
    <div class="subtitle-selection">Start by selecting an existing report data or create new</div>
    <div class="container-selection">
        <select id="year" name="year">
            <option value="" disabled selected>Select Year</option>
            <?php
                while ($row = $result_year->fetch_assoc()) {
                    echo "<option value=".$row['report_year'].">".$row['report_year']."</option>";
                };
            ?>
        </select>

        <select id="month" name="month">
            <option value="" disabled selected>Select Month</option>
            <?php
                while ($row = $result_month->fetch_assoc()) {
                    echo "<option value=".$row['report_for_month'].">".$row['report_for_month']."</option>";
                };
            ?>
        </select>

        <button class="btn-search search-data" type="submit" name="search_data">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </div>
    </div>
</div>