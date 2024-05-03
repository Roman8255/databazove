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
    include 'config.php';

    // Vytvorenie pripojenia
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Kontrola pripojenia
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Získať id z hlavičky
    $id_header = $_GET['id'];

    // SQL dotaz na získanie informácií o produkte s daným id
    $sql = $conn->prepare("
        SELECT p.id, p.`name`, p.cena, p.popis, p.cesta_k_obrazku, k.kategoria AS category_name, p.hmotnost 
        FROM product AS p
        JOIN kategorie AS k ON p.kategoria = k.id
        WHERE p.id = ?
    ");
    $sql->bind_param("i", $id_header);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
    <div class="product_stred">
        <div class="product_large">
            <img class="product_img_file" src="<?php echo htmlspecialchars($row["cesta_k_obrazku"]); ?>" alt="<?php echo htmlspecialchars($row["name"]); ?>">
            <div>
                <h2><?php echo htmlspecialchars($row["name"]); ?></h2>
                <p>Kategória: <strong><?php echo htmlspecialchars($row["category_name"]); ?></strong></p>
                <p>Cena: <?php echo htmlspecialchars($row["cena"]); ?> €</p>
                <p>Hmotnosť: <?php echo htmlspecialchars($row["hmotnost"]); ?> kg</p>
                <button class="bigbutton">
                    Pridať do košíka
                </button>
            </div>
        </div>
        <div class="product_popis">
            <p><?php echo htmlspecialchars($row["popis"]); ?></p>
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
