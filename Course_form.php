<?php 
// Suppress error messages related to including db_connect.php
@include 'db_connect.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Registration</title>
</head>
<style>
    body{
        background-color:yellow;
    }
    </style>
<body style="font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f4f9; margin: 0;">
    <form method="POST" action="" style="background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); width: 90%; max-width: 500px; text-align: left; margin: auto;">
        <h2 style="text-align: center; color: #333; margin-bottom: 20px;">Course Registration</h2>
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Name</label>
        <input type="text" name="name" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Code</label>
        <input type="text" name="code" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Year</label>
        <input type="number" name="year" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Semester</label>
        <input type="text" name="semester" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <input type="submit" name="submit_course" value="Add Course" style="background-color: #4CAF50; color: #fff; border: none; padding: 12px; width: 100%; border-radius: 4px; cursor: pointer; margin-top: 20px;">
    </form>

    <?php
    if (isset($_POST['submit_course'])) {
        $sql = "INSERT INTO course_registration (name, code, year, semester) VALUES ('{$_POST['name']}', '{$_POST['code']}', {$_POST['year']}, '{$_POST['semester']}')";
        // Check if connection exists before running query to avoid displaying errors
        if (isset($conn) && $conn->query($sql)) {
            echo "<p style='text-align: center; color: green;'>Course added successfully!</p>";
        } else {
            echo "<p style='text-align: center; color: red;'>There was an issue adding the course.</p>";
        }
    }
    ?>
</body>
</html>
