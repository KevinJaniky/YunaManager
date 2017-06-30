<?php

require_once 'fonction.php';

if (isset($_GET['stock'])) {

    $stock = $_GET['stock'];
    $bdd = connectBdd();

    if ($stock == 'all') {
        $query = $bdd->query('SELECT * FROM stock');

    } else {
        $query = $bdd->query('SELECT * FROM stock WHERE cat ="' . $stock . '"');

    }
    $res = $query->fetchAll();

    $resultat = json_encode($res);
    echo $resultat;
}

