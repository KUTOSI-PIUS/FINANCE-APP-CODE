<?php 
// Connect to the database
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
</head>
<body style="font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f4f9; margin: 0;">
    <form method="POST" action="" style="background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); width: 90%; max-width: 500px; text-align: left; margin: auto;">
        <h2 style="text-align: center; color: #333; margin-bottom: 20px;">Student Registration</h2>
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Name</label>
        <input type="text" name="name" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">AccessNo</label>
        <input type="text" name="access_no" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">IDNumber</label>
        <input type="text" name="id_number" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Contact</label>
        <input type="text" name="contact" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Program</label>
        <input type="text" name="program" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Address</label>
        <input type="text" name="address" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Email</label>
        <input type="email" name="email" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Sex</label>
        <input type="text" name="sex" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Username</label>
        <input type="text" name="username" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Password</label>
        <input type="password" name="password" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Age</label>
        <input type="number" name="age" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <input type="submit" name="submit_student" value="Register" style="background-color: #4CAF50; color: #fff; border: none; padding: 12px; width: 100%; border-radius: 4px; cursor: pointer; margin-top: 20px;">
    </form>

    <?php
    if (isset($_POST['submit_student'])) {
        
        // Use prepared statement for secure data insertion
        $stmt = $conn->prepare("INSERT INTO student_registration (Name, AccessNo, IDNumber, Contact, Program, Address, Email, Sex, Username, Password, Age) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssssssssi", 
            $_POST['name'], $_POST['access_no'], $_POST['id_number'], $_POST['contact'], 
            $_POST['program'], $_POST['address'], $_POST['email'], $_POST['sex'], 
            $_POST['username'], $password_hashed, $_POST['age']);
        
        if ($stmt->execute()) {
            echo "<p style='text-align: center; color: green;'>Student registered successfully!</p>";
        } else {
            echo "<p style='text-align: center; color: red;'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
