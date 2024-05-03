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
<div class = "page-main">
    <div class="sidebar">
        <h3>Kategórie</h3>
        <ul>
            <?php
            include 'config.php';

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $selected_category = $_GET['category'] ?? ''; 
            $selected_description = ''; 

            
            $sql_category = "SELECT kategoria, popis FROM kategorie";
            $result_category = $conn->query($sql_category);

            if ($result_category->num_rows > 0) {
                while ($row_category = $result_category->fetch_assoc()) {
                    $category_link = htmlspecialchars($row_category["kategoria"]);
                    $category_description = htmlspecialchars($row_category["popis"]);

                    if ($selected_category === $row_category["kategoria"]) {
                        $selected_description = $category_description; 
                    }

                    echo '<li><a href="?category=' . urlencode($category_link) . '">' . $category_link . '</a></li>';
                }
            } else {
                echo '<li>Žiadne kategórie</li>';
            }
            $conn->close();
            ?>
        </ul>
        <?php
        if (!empty($selected_description)) {
            echo '<p>' . $selected_description . '</p>';
        }
        ?>
    </div>


    <div class="page-container">
        <form method="GET" class="nav-bar">
            <input type="text" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Hľadať podľa názvu">
            <select name="sort">
                <option value="ASC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ASC') ? 'selected' : ''; ?>>Cena: od najnižšej</option>
                <option value="DESC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'DESC') ? 'selected' : ''; ?>>Cena: od najvyššej</option>
            </select>
            <button type="submit">Filtrovať</button>
            <?php
            // Preserve the category parameter if it exists
            if (!empty($_GET['category'])) {
                echo '<input type="hidden" name="category" value="' . htmlspecialchars($_GET['category']) . '">';
            }
            ?>
        </form>
        <div class="product-container">
            <?php

            include 'config.php';

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $search = $_GET['search'] ?? '';
            $category = $_GET['category'] ?? '';
            $sort = $_GET['sort'] ?? 'ASC';

            $search = "%{$search}%";
            if ($category === "Všetky položky") {
                $sql = $conn->prepare("SELECT id, `name`, cena, cesta_k_obrazku FROM product WHERE `name` LIKE ? ORDER BY cena $sort");
                $sql->bind_param("s", $search);
            } else {
                $sql = $conn->prepare("
                    SELECT p.id, p.`name`, p.cena, p.cesta_k_obrazku 
                    FROM product AS p
                    JOIN kategorie AS k ON p.kategoria = k.id
                    WHERE p.`name` LIKE ? AND k.kategoria = ? 
                    ORDER BY p.cena $sort
                ");

                // Bind parameters to the prepared SQL statement
                $sql->bind_param("ss", $search, $category);
            }
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="product-card">';
                    echo '<img src="' . $row["cesta_k_obrazku"] . '" class="product-image" alt="' . $row["nazov"] . '">';
                    echo '<div class="container-text">';
                    echo '<h4><b>' . $row["name"] . '</b></h4>';
                    echo '<p>' . $row["cena"] . ' €</p>';
                    echo '<button class="bigbutton" onclick="kupit(' . $row["id"] . ')">Kúpiť</button>';
                    echo '</div></div>';
                }
            } else {
                echo "Žiadne produkty k dispozícii.";
            }
            $conn-> close();
            ?>
            <script>
                function kupit(product_id) {
                    window.location.href = 'kupit.php?id=' + product_id;
                }
            </script>

        </div>
    </div>
</div>

</body>
</html>
