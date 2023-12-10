<!-- studentRegister.php -->

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection code here (similar to process_registration.php)
    $host = "your_database_host";
    $username = "your_database_username";
    $password = "your_database_password";
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
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="StudentRegister.css">
    <title>Register Form</title>
</head>
<body>
    <div class="form-container">
        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>
        <form id="multiStepForm" action="process_registration.php" method="post" class="multi-step-form">
            
            <div class="form-step" data-step="1">
                <h2>Personal Information</h2>
                <div class="role-container">
                    <!-- Make the Tutor radio button pre-selected and disabled -->
                    <label class="role">
                        <input type="radio" name="role" value="Student" id="student-radio">
                        <img src="Image/student.png" alt="Student">
                        <span class="role-label">Student</span>
                    </label>
                    
                </div>

                <!-- Step 1 Form Fields -->
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

                <label for="facebook">Facebook:</label>
                <input type="text" id="facebook" name="facebook" placeholder="Enter your Facebook username">
                <!-- Next button -->
                <button class="next-btn" data-step="2">Next</button>
            </div>

            <div class="form-step" data-step="2">
                <h2>Step 2</h2>
                <div class="role-container">
                    <label class="role">
                        <input type="radio" name="role" value="Student" id="student-radio">
                        <img src="Image/student.png" alt="Student">
                        <span class="role-label">Student</span>
                    </label>
                    
                </div>
                <!-- Step 2 Form Fields -->
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your current address" required>

                <label for="division">Select your division:</label>
                <select name="division" id="division">
                    <option value="dhaka">Dhaka</option>
                    <option value="barishal">Barishal</option>
                    <option value="khulna">Khulna</option>
                    <option value="rangpur">Rangpur</option>
                    <option value="sylhet">Sylhet</option>
                </select>
                <!-- Previous and Next buttons -->
                <button class="prev-btn" data-step="1">Previous</button>
                <button class="next-btn" data-step="3">Next</button>
            </div>

            <div class="form-step" data-step="3">
                <h2>Step 3</h2>
                <div class="role-container">
                    <label class="role">
                        <input type="radio" name="role" value="Student" id="student-radio">
                        <img src="Image/student.png" alt="Student">
                        <span class="role-label">Student</span>
                    </label>
                    
                </div>
                <!-- Step 3 Form Fields -->
                <label for="institution">Institution:</label>
                <input type="text" id="institution" name="institution" placeholder="Enter your institution name" required>

                <label for="class">Class:</label>
                <select name="class" id="class">
                    <option value="five">5</option>
                    <option value="six">6</option>
                    <option value="seven">7</option>
                    <option value="eight">8</option>
                    <option value="nine">9</option>
                    <option value="ten">10</option>
                    <option value="eleven">11</option>
                    <option value="twelve">12</option>
                    <option value="admission">Admission</option>
                </select>
                <!-- Previous and Next buttons -->
                <button class="prev-btn" data-step="2">Previous</button>
                <button class="next-btn" data-step="4">Next</button>
            </div>

            <div class="form-step" data-step="4">
                <h2>Step 4</h2>
                <div class="role-container">
                    <label class="role">
                        <input type="radio" name="role" value="Student">
                        <img src="Image/student.png" alt="Student">
                        <span class="role-label">Student</span>
                    </label>
                </div>
                <!-- Step 4 Form Fields -->
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirmpassword">Confirm password:</label>
                <input type="password" id="confirmpassword" name="confirmpassword" required>
                <!-- Add your form fields for step 5 here -->
                <button class="prev-btn" data-step="3">Previous</button>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script src="studentRegister.js"></script>
</body>
</html>