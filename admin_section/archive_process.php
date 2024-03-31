<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the report_id is set and not empty
    if (isset($_POST["report_id"]) && !empty($_POST["report_id"])) {
        // Redirect to the archive_report.php page with the report_id passed through the URL
        header("Location: archive_report.php?report_id=" . $_POST["report_id"]);
        exit; // Stop further execution
    } else {
        echo "Error: Report ID is missing.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
