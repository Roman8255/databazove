<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obrázková Galéria</title>
    <link rel="stylesheet" type="text/css" href="galery_style.css">
</head>
<body>

<header>
    <?php include 'header.php'; ?>
</header>

<div class="grid-container">
    <?php
    // Adresár s obrázkami
    $photo_dir = 'photos';
    
    // Načítanie zoznamu súborov z adresára
    $photos = scandir($photo_dir);
    
    // Prechádzanie cez súbory
    foreach ($photos as $photo) {
        // Preskočíme špeciálne adresáre . a ..
        if ($photo != '.' && $photo != '..') {
            // Kontrola, či súbor je obrázok
            if (is_file($photo_dir . '/' . $photo) && (pathinfo($photo_dir . '/' . $photo, PATHINFO_EXTENSION) == 'jpg' || pathinfo($photo_dir . '/' . $photo, PATHINFO_EXTENSION) == 'jpeg' || pathinfo($photo_dir . '/' . $photo, PATHINFO_EXTENSION) == 'png')) {
                echo '<div class="grid-item"><img src="' . $photo_dir . '/' . $photo . '" alt="' . $photo . '"></div>';
            }
        }
    }
    ?>
</div>

<div class="overlay" id="overlay">
    <span class="close" id="close">&times;</span>
    <img id="expandedImg">
</div>

<script src="scripts.js"></script>

</body>
</html>
