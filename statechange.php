<?php
require "fonction.php";
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $bdd = connectBdd();
    $query = $bdd->query('UPDATE mail SET etat = 0 WHERE id = ' . $id);

} else {
    header('location:mailbox.php?error_changestate');
    die();
}