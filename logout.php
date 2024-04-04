<?php
session_start(); // Otvorenie session

// Vymazanie všetkých premenných v session
$_SESSION = array();

// Ak chcete úplne zrušiť session, môžete vymazať aj cookie, ktoré identifikuje session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Nakoniec zničte session
session_destroy();

echo 'You have logged out and cleaned the session.';

// Presmerovanie na inú stránku
header('Refresh: 1; URL = login.php');
?>
