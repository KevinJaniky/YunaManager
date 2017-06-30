<?php
require_once "fonction.php";

if (!empty($_POST["mail"]) && !empty($_POST["mdp"])) {
    $mail = htmlspecialchars(trim($_POST["mail"]));
    $mdp = htmlspecialchars(trim($_POST["mdp"]));
    $error = false;

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $error = true;
    }
    if (strlen($mdp) < 5) {
        $error = true;
    }

    if ($error) {
        header("location:index.php?empty_field");
        die();
    } else {
        if (createSession($mail, $mdp) == true) {
            header("location:dashboard.php");
            die();

        } else {
            header("location:index.php?not_found");
            die();
        }
    }

} else {
    header("location:index.php?empty_field");
    die();
}

