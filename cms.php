<?php
session_start();
include 'header.php'; 
// Kontrola, či je používateľ prihlásený. Ak nie, presmerujte na prihlasovaciu stránku.
if (!isset($_SESSION['valid']) || $_SESSION['valid'] !== true) {
    header('Location: login.php'); // Presmerovanie na login.php alebo na inú stránku.
    exit;
}
//zistenie ci je session nastavene
if(isset($_SESSION['username']) ) {
     
    

    echo 'Click here to <a href = "logout.php" tite = "Logout">logout.';//odkaz na odhlasenie
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet"  href="cms_style.css">
</head>
<body>

        
        
    
<form action="upload.php" method="post" enctype="multipart/form-data">
    Vyberte fotky na nahratie:
    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
    <input type="submit" value="Nahrať fotky" name="submit">
</form>

<?php
$files = glob("photos/*.*");
$files = array_combine($files, array_map("filemtime", $files));
arsort($files);

$files = array_keys($files);

echo '<div class="grid-container">';

for ($i=0; $i<count($files); $i++)
{
    $image = $files[$i];
    echo '<div class="grid-item">';
    echo '<img src="'.$image .'" alt="Random image" />';
    echo '<br />';
    echo '<a href="delete.php?name='.$image.'">Vymazať</a>';
    echo '</div>';
}

echo '</div>';
?>

