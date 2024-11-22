<?php 

$conn = new mysqli('localhost', 
'root','', 'dit_db',3307);


if ($conn->connect_error) {
    die("Error connecting to database: ".$connection->error);
}else {
    echo "Connection established successfully ";
}

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pass = md5($password); // encrypted password


    $sql = "INSERT INTO user_tb( user_name,password, email  ) 
             VALUES ( '$username', '$pass' ,'$email' );";
    

            if($conn -> query($sql) === TRUE) {
                echo "Data Saved successfully";
            } else{
            echo "Data Saved failed";
                }

    // echo "<h1> Welcome ".$username." </h1>";
    // echo "<h2> Your email is ".$email." </h2>";
    // echo "<h2> Your password is ".$pass." </h2>";







  


?>