<?php
include 'db_connect.php'; // Include your database connection file

// Check connection
if ($conn) {
    echo "Connected successfully to the database.";
} else {
    echo "Connection failed: " . $conn->connect_error;
}

$conn->close(); // Close the connection
?>
