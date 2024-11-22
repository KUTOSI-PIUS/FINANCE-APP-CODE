<?php
include("db_connect.php");

// Ensure that 'table' and 'Code' parameters are set
if (isset($_GET['table']) && isset($_GET['Code'])) {
    $table = $_GET['table'];
    $code = $_GET['Code']; // Use 'code' for consistency

    // Sanitize the input
    $table = mysqli_real_escape_string($conn, $table);
    $code = mysqli_real_escape_string($conn, $code);

    // Prepare the SQL statement
    $sql = "DELETE FROM $table WHERE Code='$code'"; // Use quotes for string comparison

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully from $table";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
    header("Location: Course_form.php"); // Redirect back to main page (adjust if needed)
    exit();
} else {
    echo "Invalid request.";
}
?>
