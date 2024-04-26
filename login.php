<?php
session_start();   //otvorenie session
$error_message = 'Password';
//kontrola ci uz bol potvrdeny formular a ci boli vyplnene obidva udaje aj username aj password
//kontrola ci uz bol potvrdeny formular a ci boli vyplnene obidva udaje aj username aj password
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

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

    // Escaping to prevent SQL injection
    $username2 = $conn->real_escape_string($_POST['username']);
    $password2 = $conn->real_escape_string($_POST['password']);

    // Select user from the database
    $sql = "SELECT password FROM t_user WHERE username ='$username2'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            $hashed_password_from_db = $row["password"];
            
            // Verify the password
            if (password_verify($password2, $hashed_password_from_db)) {
                $_SESSION['valid'] = true; //ulozenie session
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $username;

                //presmerovanie na dalsiu stranku
                header("Location: cms.php", true, 301);
                exit();
            } else {
                $error_message = "Wrong password";
            }
        } else {
            $error_message = "Wrong username or password"; // pridane upresnenie pre zle meno alebo heslo
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}


//formular            
?>
<!DOCTYPE html>
<html>  

<head>
    <title>Login and Register</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
    
</head>
<header>    
    <?php include 'header.php'; ?>
    
</header>

<body>
    <div class="container">
        <h2 id="loginHeading">Login</h2>
        <form id="loginForm" action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required autofocus><br>
            <input type="password" name="password" placeholder="<?php echo isset($error_message) ? $error_message : 'New Password'; ?>" required><br>
            <input type="submit" name="login" value="Login">
            <button onclick="showRegisterForm()">Register</button>
        </form>
        <br>
        <!-- Formulář pro registraci -->
        <div class="register-form" id="registerForm" style="display: none;">
            <h2>Register</h2>
            <form action="register.php" method="post">
                <input type="text" name="new_username" placeholder="New Username" required><br>
                <input type="password" name="new_password" placeholder="New Password" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="submit" name="register" value="Register">
            </form>
            <br>
            <!-- Tlačítko pro skrytí formuláře pro registraci -->
            <button onclick="hideRegisterForm()">Login</button>
        </div>

        <!-- Tlačítko pro otevření registračního formuláře -->
        
    </div>

    <script>
        function showRegisterForm() {
            var loginHeading = document.getElementById('loginHeading');
            var loginForm = document.getElementById('loginForm');
            var registerForm = document.getElementById('registerForm');

            loginHeading.style.display = 'none'; // Skryje nadpis
            loginForm.style.display = 'none'; // Skryje formulář pro přihlášení
            registerForm.style.display = 'block'; // Zobrazí formulář pro registraci
        }

        function hideRegisterForm() {
            var loginHeading = document.getElementById('loginHeading');
            var loginForm = document.getElementById('loginForm');
            var registerForm = document.getElementById('registerForm');

            loginHeading.style.display = 'block'; // Zobrazí nadpis
            loginForm.style.display = 'block'; // Zobrazí formulář pro přihlášení
            registerForm.style.display = 'none'; // Skryje formulář pro registraci
        }
    </script>
</body>

</html>
