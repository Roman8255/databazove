<?php
session_start(); //otvorenie session

//kontrola ci uz bol potvrdeny formular a ci boli vyplnene obidva udaje aj username aj password
if (isset($_POST['register']) && !empty($_POST['new_username']) && !empty($_POST['new_password']) && !empty($_POST['email'])) {

    //connect string do DB
    $servername = "localhost";
    $username = "bednarik3a";
    $password = "bednarik3a";
    $dbname = "bednarik3a";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $email = $_POST['email'];

    //kontrola, ci uz neexistuje uzivatel s danym menom
    $check_sql = "SELECT * FROM t_user WHERE username='$new_username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Username already exists!";
    } else {
        //vlozenie noveho pouzivatela do tabulky
        $encrypted = password_hash($new_password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO t_user (username, password, email) VALUES ('$new_username', '$encrypted', '$email')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "New user registered successfully!";
            header('Refresh: 2; URL = login.php');
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
