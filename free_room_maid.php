<?php
require "fonction.php";
if (isConnected()) {
    if (isset($_POST['id']) && isset($_POST['dispo'])) {
        $id = $_POST['id'];

        $bdd = connectBdd();
        $query = $bdd->prepare('UPDATE chambre SET etat = :etat WHERE id = :id');
        $query->execute([
            'etat' => 0,
            'id' => $id
        ]);

        header('location:dashboard.php');
        die();
    } else {
        header('location:page_404.php');
        die();
    }
} else {
    header('location:index.php');
    die();
}

