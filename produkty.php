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
<form method="GET">
    <input type="text" name="search" placeholder="Hľadať podľa názvu">
    <select name="sort">
        <option value="ASC">Cena: od najnižšej</option>
        <option value="DESC">Cena: od najvyššej</option>
    </select>
    <button type="submit">Filtrovať</button>
</form>
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
    $search = $_GET['search'] ?? '';
    $sort = $_GET['sort'] ?? 'ASC';  // Default sorting by ascending price

    // Bezpečné použitie parametrov vo výbere SQL
    $search = "%{$search}%";
    $sql = $conn->prepare("SELECT id, `name`, cena, cesta_k_obrazku FROM product WHERE `name` LIKE ? ORDER BY cena $sort");
    $sql->bind_param("s", $search);
    $sql->execute();
    $result = $sql->get_result();

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



