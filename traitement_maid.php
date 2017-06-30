<?php
require_once 'fonction.php';

if(isset($_POST['element']) && isset($_POST['id'])) {
    $elem = $_POST['element'];
    $nb = count($elem);
    $id = $_POST['id'];

    $bdd = connectBdd();

    for($i = 0;$i<$nb;$i++){

        if($elem[$i] == 'bienvenue'){
            plateauBienvenu();
        }else {
            elemMoinsSotck($elem[$i]);
        }
    }
    changestatefree($id);
    header('location:index.php');
    die();
}

else {
    header('location:index.php');
    die();
}