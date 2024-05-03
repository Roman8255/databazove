<?php
session_start(); // Start the session

// Check if the form was submitted and all required fields are filled
if (isset($_POST['register']) && !empty($_POST['new_username']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password']) && !empty($_POST['email'])) {

    include 'config.php'; // Include database configuration

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Check if the entered passwords match
    if ($new_password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Check if the username already exists
        $check_sql = "SELECT * FROM t_user WHERE username = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("s", $new_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Username already exists!";
        } else {
            // Insert the new user into the database
            $encrypted = password_hash($new_password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO t_user (username, password, email) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param("sss", $new_username, $encrypted, $email);
            if ($stmt->execute() === TRUE) {
                echo "New user registered successfully!";
                header('Refresh: 2; URL = login.php');
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        $stmt->close();
    }
    $conn->close();
}
?>
