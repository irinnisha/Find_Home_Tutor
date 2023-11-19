<?php
$servername = "localhost:3306"; 
$username = "root";
//$password = "your_mysql_password"; 
$dbname = "Find_Home_Tutor";   

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST["role"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password (for security, consider using a stronger hashing algorithm and salting)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (role, email, password) VALUES ('$role', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
