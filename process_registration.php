<?php
// Connection parameters
$host = "localhost:3306";
$username = "root";
$password = "";
$database = "aimers";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$facebook = $_POST['facebook'];
$address = $_POST['address'];
$division = $_POST['division'];
$institution = $_POST['institution'];
$class = $_POST['class'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// SQL query to insert data into the database
$sql = "INSERT INTO students (name, email, phone, facebook, address, division, institution, class, password)
        VALUES ('$name', '$email', '$phone', '$facebook', '$address', '$division', '$institution', '$class', '$password')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Registration successful";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
