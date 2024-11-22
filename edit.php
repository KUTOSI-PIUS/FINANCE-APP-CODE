<?php
include("db_connect.php");

// Ensure 'Semester' is set in the GET request
if (!isset($_GET['Semester'])) {
    die("Missing required parameter: Semester.");
}

// Sanitize the inputs
$table = "course_registration"; // Set your table name explicitly
$Code = mysqli_real_escape_string($conn, $_GET['Semester']);

// Fetch the record based on Code
$sql = "SELECT * FROM $table WHERE Semester='$Semester'";
$result = $conn->query($sql);

// Check if the query was successful and returned a result
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("No record found with Semester: $Semester.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Record</title>
</head>
<body>
    <h2>Edit Record in <?php echo ucfirst($table); ?></h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>">
        <input type="hidden" name="Semester" value="<?php echo htmlspecialchars($row['Semester']); ?>">

        <?php
        // Loop through each column in the record and display editable fields
        foreach ($row as $column => $value) {
            if ($column != 'Semester') { // Skip the Semester field for editing
                echo "<label>" . htmlspecialchars($column) . ":</label><br>";
                echo "<input type='text' name='" . htmlspecialchars($column) . "' value='" . htmlspecialchars($value) . "' required><br><br>";
            }
        }
        ?>

        <input type="submit" value="Update">
    </form>
</body>
</html>
