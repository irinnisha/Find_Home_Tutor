<?php
 //require_once('db_connection.php');

// Assuming your database connection is established, replace the following with your actual connection code
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "Find_Home_Tutor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 1 data
    $role = $_POST["role"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    // Insert data into 'users' table
    $stmt = $conn->prepare("INSERT INTO users (role, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $role, $email, $password);

    // Check if the insertion was successful
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>