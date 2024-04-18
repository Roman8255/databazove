<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkt</title>
    <link rel="stylesheet" type="text/css" href="galery_style.css">
</head>
<body>

<header>
    <?php include 'header.php'; ?>
</header>

<div >
    <?php

    $servername = "localhost";
    $username = "bednarik3a";
    $password = "bednarik3a";
    $dbname = "bednarik3a";

    // Vytvorenie pripojenia
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Kontrola pripojenia
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Získať id z hlavičky
    $id_header = $_GET['id'];

    // SQL dotaz na získanie informácií o produkte s daným id
    $sql = "SELECT id, `name`, cena, popis,cesta_k_obrazku, hmotnost FROM product WHERE id=$id_header";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
    <div class="product_stred">
        <div class="product_large">
            <img class="product_img_file"src="<?php echo $row["cesta_k_obrazku"]; ?>" alt="<?php echo $row["name"]; ?>">
            <div>
                <h2><?php echo $row["name"]; ?></h2>
                <p>Cena: <?php echo $row["cena"]; ?> €</p>
                <p>Hmotnosť: <?php echo $row["hmotnost"]; ?> kg</p>
            </div>
        </div>
            <div class="product_popis">
        <p><?php echo $row["popis"]; ?></p>
    </div>
    <?php
        }
    } else {
        echo "Žiadne informácie k dispozícii.";
    }

    $conn->close();

    ?>
</div>

</body>
</html>
