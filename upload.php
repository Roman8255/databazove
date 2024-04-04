
<?php

$target_dir = "photos/";

foreach($_FILES["fileToUpload"]["name"] as $key=>$name) {
    $target_file = $target_dir . basename($name);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Skontrolujte, či je súbor obrázok
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
    if($check !== false) {
        echo "Súbor je obrázok - " . $check["mime"] . ".";
    } else {
        echo "Súbor nie je obrázok.";
        continue;
    }

    // Skontrolujte, či súbor už existuje
    if (file_exists($target_file)) {
      echo "Prepáčte, súbor už existuje.";
      continue;
    }

    // Skúste nahrať súbor
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
      echo "Súbor ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$key])). " bol úspešne nahraný.";
    } else {
      echo "Prepáčte, pri nahrávaní súboru sa vyskytla chyba.";
    }
    
}

header('Refresh: 1; URL = cms.php');
?>
