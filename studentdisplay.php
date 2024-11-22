<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
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
        form input[type="email"],
        form input[type="password"],
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
            background-color: #45a049;
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

<h1>Welcome to the Student Registration Page</h1>

<!-- Form Section -->
<form action="" method="POST">
    <label for="Name">Name</label><br>
    <input type="text" name="Name" required><br><br>
    
    <label for="AccessNo">Access Number</label><br>
    <input type="text" name="AccessNo" required><br><br>
    
    <label for="IDNumber">ID Number</label><br>
    <input type="text" name="IDNumber" required><br><br>
    
    <label for="Program">Program</label><br>
    <input type="text" name="Program" required><br><br>

    <label for="Address">Address</label><br>
    <input type="text" name="Address" required><br><br>

    <label for="Email">Email</label><br>
    <input type="email" name="Email" required><br><br>

    <label for="Sex">Sex</label><br>
    <input type="text" name="Sex" required><br><br>

    <label for="Username">Username</label><br>
    <input type="text" name="Username" required><br><br>

    <label for="Password">Password</label><br>
    <input type="password" name="Password" required><br><br>
    
    <input type="submit" value="Submit">
</form>

<!-- PHP to handle form data insertion -->
<?php
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $accessno = $_POST['AccessNo'];
    $idNumber = $_POST['IDNumber'];
    $program = $_POST['Program'];
    $address = $_POST['Address'];
    $email = $_POST['Email'];
    $sex = $_POST['Sex'];
    $username = $_POST['Username'];
    $password = password_hash($_POST['Password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO student_registration (Name, AccessNo, IDNumber, Program, Address, Email, Sex, Username, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $name, $accessno, $idNumber, $program, $address, $email, $sex, $username, $password);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>New student registered successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
    $stmt->close();
}

$sql = "SELECT * FROM student_registration";
$results = $conn->query($sql);
?>

<!-- Table Section -->
<table>
    <tr>
        <th>Name</th>
        <th>Access No</th>
        <th>ID Number</th>
        <th>Program</th>
        <th>Address</th>
        <th>Email</th>
        <th>Sex</th>
        <th>Username</th>
        <th>Password</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($results->num_rows > 0) {       
        while($row = $results->fetch_assoc()){
            echo "<tr>
                    <td>" . htmlspecialchars($row['Name']) . "</td>
                    <td>" . htmlspecialchars($row['AccessNo']) . "</td>
                    <td>" . htmlspecialchars($row['IDNumber']) . "</td>
                    <td>" . htmlspecialchars($row['Program']) . "</td>
                    <td>" . htmlspecialchars($row['Address']) . "</td>
                    <td>" . htmlspecialchars($row['Email']) . "</td>
                    <td>" . htmlspecialchars($row['Sex']) . "</td>
                    <td>" . htmlspecialchars($row['Username']) . "</td>
                    <td>" . htmlspecialchars($row['Password']) . "</td>
                    <td>
                        <a href='edit.php?AccessNo=" . urlencode($row['AccessNo']) . "'><button>Edit</button></a>
                        <a href='delete.php?AccessNo=" . urlencode($row['AccessNo']) . "' onclick='return confirm(\"Are you sure?\");'><button>Delete</button></a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='10' style='text-align: center;'>No results found</td></tr>";
    }
    ?>
</table>

</body>
</html>
