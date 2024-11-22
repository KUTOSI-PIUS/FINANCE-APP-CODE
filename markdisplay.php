<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mark Entry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: orange;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            margin-bottom: 30px;
        }

        form label {
            font-weight: bold;
            color: blue;
            display: block;
            margin-top: 10px;
        }

        form input[type="text"],
        form input[type="number"],
        form textarea,
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
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th,
        table td {
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
    </style>
</head>
<body>
    
    <!-- Mark Entry Form -->
    <form method="POST" action="">
        <h2 style="text-align: center; margin-bottom: 20px;">Mark Entry</h2>
        
        <label>Course ID</label>
        <input type="text" name="Course_ID" required>
        
        <label>Mark</label>
        <input type="number" name="mark" required>
        
        <label>Grade</label>
        <input type="text" name="grade" required>
        
        <label>Comment</label>
        <textarea name="comment"></textarea>
        
        <input type="submit" name="submit_mark" value="Add Mark">
    </form>

    <?php
    @include 'db_connect.php';

    if (isset($_POST['submit_mark'])) {
        $stmt = $conn->prepare("INSERT INTO mark_entry (Course_ID, mark, grade, comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $_POST['Course_ID'], $_POST['mark'], $_POST['grade'], $_POST['comment']);

        if ($stmt->execute()) {
            echo "<p style='text-align: center; color: green;'>Mark entry added successfully!</p>";
        } else {
            echo "<p style='text-align: center; color: red;'>There was an issue adding the mark entry: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $sql = "SELECT * FROM mark_entry";
    $results = $conn->query($sql);
    ?>

    <!-- Table to Display Marks -->
    <table>
        <tr>
            <th>Course ID</th>
            <th>Mark</th>
            <th>Grade</th>
            <th>Comment</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['Course_ID']) . "</td>
                        <td>" . htmlspecialchars($row['Mark']) . "</td>
                        <td>" . htmlspecialchars($row['Grade']) . "</td>
                        <td>" . htmlspecialchars($row['Comment']) . "</td>
                        <td>
                            <a href='edit_mark.php?Course_ID=" . urlencode($row['Course_ID']) . "'><button>Edit</button></a>
                            <a href='delete_mark.php?Course_ID=" . urlencode($row['Course_ID']) . "' onclick='return confirm(\"Are you sure?\");'><button>Delete</button></a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align: center;'>No marks found</td></tr>";
        }
        ?>
    </table>

</body>
</html>
