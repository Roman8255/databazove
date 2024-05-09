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
        <div class="statistics">
    <h3>Štatistika cien</h3>
    <?php
    include 'config.php';

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $category = $_GET['category'] ?? '';

    if ($category !== '' && $category !== 'Všetky položky') {
        $stmt = $conn->prepare("
            SELECT MIN(p.cena) AS najnizsia_cena, MAX(p.cena) AS najvyssia_cena, SUM(p.cena) AS suma_cien, AVG(p.cena) AS priemerna_cena
            FROM product p
            JOIN kategorie k ON p.kategoria = k.id
            WHERE k.kategoria = ?
        ");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result_stats = $stmt->get_result();
    } else {
        $result_stats = $conn->query("
            SELECT MIN(cena) AS najnizsia_cena, MAX(cena) AS najvyssia_cena, SUM(cena) AS suma_cien, AVG(cena) AS priemerna_cena
            FROM product
        ");
    }

    if ($result_stats->num_rows > 0) {
        $row_stats = $result_stats->fetch_assoc();
        echo "<table>";
        echo "<tr><td>Najnižšia cena:</td><td>" . $row_stats['najnizsia_cena'] . " €</td></tr>";
        echo "<tr><td>Najvyššia cena:</td><td>" . $row_stats['najvyssia_cena'] . " €</td></tr>";
        echo "<tr><td>Suma všetkých cien:</td><td>" . number_format($row_stats['suma_cien'], 2). " €</td></tr>";
        echo "<tr><td>Priemerná cena:</td><td>" . number_format($row_stats['priemerna_cena'], 2) . " €</td></tr>";
        echo "</table>";
    } else {
        echo "Žiadne údaje pre štatistiky.";
    }

    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
    ?>
</div>

    </div>


    <div class="page-container">
        <form method="GET" class="nav-bar">
            <input type="text" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Hľadať podľa názvu">
            <select name="sort">
                <option value="ASC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ASC') ? 'selected' : ''; ?>>Cena: od najnižšej</option>
                <option value="DESC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'DESC') ? 'selected' : ''; ?>>Cena: od najvyššej</option>
                <option value="AZ" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'AZ') ? 'selected' : ''; ?>>Názov: od A po Z</option>
                <option value="ZA" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ZA') ? 'selected' : ''; ?>>Názov: od Z po A</option>
                <option value="idASC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'idASC') ? 'selected' : ''; ?>>ID: vzostupne</option>
                <option value="idDESC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'idDESC') ? 'selected' : ''; ?>>ID: zostupne</option>
            </select>
            <button type="submit">Filtrovať</button>
            <?php
            // Zachovanie kategórie v prípade, že bola vybratá
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

            // Určte poradie na základe hodnoty 'sort' parametra
            switch ($sort) {
                case 'ASC':
                    $order_by = 'cena ASC';
                    break;
                case 'DESC':
                    $order_by = 'cena DESC';
                    break;
                case 'AZ':
                    $order_by = '`name` ASC';
                    break;
                case 'ZA':
                    $order_by = '`name` DESC';
                    break;
                case 'idASC':
                    $order_by = 'id ASC';
                    break;
                case 'idDESC':
                    $order_by = 'id DESC';
                    break;
                default:
                    $order_by = 'cena ASC';
                    break;
            }

            // Hľadanie podľa zadaného textu
            $search = "%{$search}%";

            // SQL dotaz s filtrom na kategóriu
            if ($category === "Všetky položky") {
                $sql = $conn->prepare("SELECT id, `name`, cena, cesta_k_obrazku FROM product WHERE `name` LIKE ? ORDER BY $order_by");
                $sql->bind_param("s", $search);
            } else {
                $sql = $conn->prepare("
                    SELECT p.id, p.`name`, p.cena, p.cesta_k_obrazku
                    FROM product AS p
                    JOIN kategorie AS k ON p.kategoria = k.id
                    WHERE p.`name` LIKE ? AND k.kategoria = ?
                    ORDER BY $order_by
                ");
                $sql->bind_param("ss", $search, $category);
            }

            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-card">';
                    echo '<img src="' . $row["cesta_k_obrazku"] . '" class="product-image" alt="' . htmlspecialchars($row["name"]) . '">';
                    echo '<div class="container-text">';
                    echo '<h4><b>' . htmlspecialchars($row["name"]) . '</b></h4>';
                    echo '<p>' . $row["cena"] . ' €</p>';
                    echo '<button class="bigbutton" onclick="kupit(' . $row["id"] . ')">Kúpiť</button>';
                    echo '</div></div>';
                }
            } else {
                echo "Žiadne produkty k dispozícii.";
            }

            $sql->close();
            $conn->close();
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
