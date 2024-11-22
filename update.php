<?php
include("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table = $_POST['table'];
    $Code = $_POST['Code'];

    // Sanitize inputs
    $table = mysqli_real_escape_string($conn, $table);
    $Code = mysqli_real_escape_string($conn, $Code);

    // Build the SET part of the SQL dynamically
    $set_values = [];
    foreach ($_POST as $column => $value) {
        if ($column != 'table' && $column != 'Code') {
            $value = mysqli_real_escape_string($conn, $value); // Sanitize each value
            $set_values[] = "$column='$value'";
        }
    }
    $set_query = implode(", ", $set_values);

    // Use quotes around Code if it's a string
    $sql = "UPDATE $table SET $set_query WHERE Code='$Code'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully in $table";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
    header("Location: Course_form.php"); // Redirect back to main page (adjust if needed)
    exit();
}
?>
