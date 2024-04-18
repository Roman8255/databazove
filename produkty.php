<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkty</title>
    <link rel="stylesheet" type="text/css" href="galery_style.css">
</head>
<body>

<header>
    <?php include 'header.php'; ?>
</header>

<div class="product-container">
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
    // SQL dotaz na získanie všetkých produktov
    $sql = "SELECT id, `name`, cena, cesta_k_obrazku FROM product";
    $result = $conn->query($sql);

    // Výpis kariet pre každý produkt
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="product-card">';
            echo '<img src="' . $row["cesta_k_obrazku"] . '" class="product-image" alt="' . $row["nazov"] . '">';

            echo '<div class="container">';
            echo '<h4><b>' . $row["name"] . '</b></h4>';
            echo '<p>' . $row["cena"] . ' €</p>';
            echo '<button onclick="kupit(' . $row["id"] . ')">Kúpiť</button>';
            echo '</div></div>';
        }
    } else {
        echo "Žiadne produkty k dispozícii.";
    }
    $conn->close();
    ?>
    <script>
        function kupit(product_id) {
            window.location.href = 'kupit.php?id=' + product_id;
        }
    </script>

</div>



</body>
</html>



