<?php @include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mark Entry</title>
</head>
<body style="font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f4f9; margin: 0;">
    <form method="POST" action="" style="background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); width: 90%; max-width: 500px; text-align: left; margin: auto;">
        <h2 style="text-align: center; color: #333; margin-bottom: 20px;">Mark Entry</h2>
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Course ID</label>
        <input type="number" name="Course_ID" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Mark</label>
        <input type="number" name="mark" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Grade</label>
        <input type="text" name="grade" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
        
        <label style="display: block; margin-top: 10px; font-weight: bold; color: #555;">Comment</label>
        <textarea name="comment" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
        
        <input type="submit" name="submit_mark" value="Add Mark" style="background-color: #4CAF50; color: #fff; border: none; padding: 12px; width: 100%; border-radius: 4px; cursor: pointer; margin-top: 20px;">
    </form>

    <?php
    if (isset($_POST['submit_mark'])) {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO mark_entry (Course_ID, mark, grade, comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $_POST['Course_ID'], $_POST['mark'], $_POST['grade'], $_POST['comment']); // Adjust types as necessary

        if ($stmt->execute()) {
            echo "<p style='text-align: center; color: green;'>Mark entry added successfully!</p>";
        } else {
            echo "<p style='text-align: center; color: red;'>There was an issue adding the mark entry: " . $stmt->error . "</p>";
        }

        $stmt->close(); // Close the prepared statement
    }
    ?>
</body>
</html>
