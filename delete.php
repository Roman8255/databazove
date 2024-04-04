<?php
if(isset($_GET['name'])){
    unlink($_GET['name']);
    echo 'Fotka bola vymazaná.';
} else {
    echo 'Chyba: Nebola zadaná fotka na vymazanie.';
}
header('Refresh: 1; URL = cms.php');
?>
