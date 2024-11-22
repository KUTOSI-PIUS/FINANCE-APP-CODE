<?php
include 'db_connect.php'; // Include your database connection file

// Query to select all data from user_tb table
$sql = "SELECT * FROM course_registration";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display course_registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Course Registration</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Year</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Name'] . "</td>"; // Adjust to your actual column names
                    echo "<td>" . $row['Code'] . "</td>";
                    echo "<td>" . $row['Year'] . "</td>";
                    echo "<td>" . $row['Semester'] . "</td>"; // Encrypted password display
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
