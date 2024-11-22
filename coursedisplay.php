<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: orange;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            margin-bottom: 30px;
        }

        form label {
            font-weight: bold;
            color: blue;
        }

        form input[type="text"],
        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: blue;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        form input[type="submit"]:hover {
            background-color: blue;
        }

        table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
        }

        table th {
            background-color: #4CAF50;
            color: blue;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:nth-child(odd) {
            background-color: #fff;
        }

        table td {
            color: #555;
        }

        table a button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        table a button:hover {
            background-color: #45a049;
        }

        table td a {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<h1>Welcome to the Course Registration Page</h1>

<!-- Form Section -->
<form action="" method="POST">
    <label for="Name">Name</label><br>
    <input type="text" name="Name" required><br><br>
    
    <label for="Code">Code</label><br>
    <input type="text" name="Code" required><br><br>
    
    <label for="Year">Year</label><br>
    <input type="text" name="Year" required><br><br>
    
    <label for="Semester">Semester</label><br>
    <input type="text" name="Semester" required><br><br>
    
    <input type="submit" value="Submit">
</form>

<!-- PHP to handle form data insertion -->
<?php
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $code = $_POST['Code'];
    $year = $_POST['Year'];
    $semester = $_POST['Semester'];

    $stmt = $conn->prepare("INSERT INTO course_registration (Name, Code, Year, Semester) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $code, $year, $semester);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>New course registered successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
    $stmt->close();
}

$sql = "SELECT * FROM course_registration";
$results = $conn->query($sql);
?>

<!-- Table Section -->
<table>
    <tr>
        <th>Name</th>
        <th>Code</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($results->num_rows > 0) {       
        while($row = $results->fetch_assoc()){
            echo "<tr>
                    <td>" . htmlspecialchars($row['Name']) . "</td>
                    <td>" . htmlspecialchars($row['Code']) . "</td>
                    <td>" . htmlspecialchars($row['Year']) . "</td>
                    <td>" . htmlspecialchars($row['Semester']) . "</td>
                    <td>
                        <a href='edit.php?Code=" . urlencode($row['Code']) . "'><button>Edit</button></a>
                        <a href='delete.php?Code=" . urlencode($row['Code']) . "' onclick='return confirm(\"Are you sure?\");'><button>Delete</button></a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5' style='text-align: center;'>No results found</td></tr>";
    }
    ?>
</table>

</body>
</html>
