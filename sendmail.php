<?php
require_once 'fonction.php';

if (!empty($_POST['dest']) && !empty($_POST['obj']) && !empty($_POST['msg']) && !empty($_SESSION['id'])) {
    $dest = $_POST['dest'];
    $obj = htmlspecialchars(trim($_POST['obj']));
    $msg = (trim($_POST['msg']));
    $id = $_SESSION['id'];
    $error = false;

    if (strlen($obj) < 5) {
        $error = true;
    }
    if (strlen($msg) < 2) {
        $error = true;
    }
    if ($error) {
        header('location:mailbox.php?send_error');
        die();
    } else {

        $bdd = connectBdd();
        $query = $bdd->prepare('INSERT INTO mail(message,dest,exp,obj) VALUES (:msg,:dest,:exp,:obj)');
        $query->execute([
            "msg" => $msg,
            "dest" => $dest,
            "exp" => $id,
            "obj" => $obj
        ]);
        header('location:mailbox.php?send_success');
        die();
    }
} else {
    header("location:mailbox.php?empty_field");
    die();
}