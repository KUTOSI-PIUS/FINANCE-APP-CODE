<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Registration</title>
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
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            max-width: 600px;
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

<h1>Welcome to the Department Registration Page</h1>

<!-- Form Section -->
<form action="Department_form.php" method="POST">
    <label for="Name">Department Name</label><br>
    <input type="text" name="Name" required><br><br>
    
    <label for="Head">Head of Department</label><br>
    <input type="text" name="Head" required><br><br>
    
    <input type="submit" value="Submit">
</form>

<!-- PHP to handle form data insertion -->
<?php
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $head = $_POST['Head'];

    $insert_sql = "INSERT INTO department_registration (Name, Head) VALUES ('$name', '$head')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "<p style='color: green;'>New department registered successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}

$sql = "SELECT * FROM department_registration";
$results = $conn->query($sql);
?>

<!-- Table Section -->
<table>
    <tr>
        <th>Department Name</th>
        <th>Head</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($results->num_rows > 0) {       
        while($row = $results->fetch_assoc()){
            echo "<tr>
                    <td>" . htmlspecialchars($row['Name']) . "</td>
                    <td>" . htmlspecialchars($row['Head']) . "</td>
                    <td>
                        <a href='edit.php?Name=" . urlencode($row['Name']) . "'><button>Edit</button></a>
                        <a href='delete.php?Name=" . urlencode($row['Name']) . "' onclick='return confirm(\"Are you sure?\");'><button>Delete</button></a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3' style='text-align: center;'>No results found</td></tr>";
    }
    ?>
</table>

</body>
</html>
