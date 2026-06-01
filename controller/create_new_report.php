<?php
    session_start();

    $_SESSION['month_year_id'] = "";

    session_unset();
    session_destroy();

    echo json_encode([
        "success" => true
    ]);
?>