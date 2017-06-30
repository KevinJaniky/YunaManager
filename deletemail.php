<?php
require_once "fonction.php";
if (isConnected()) {
    if (isset($_POST['delete'])) {

        $del = $_POST['delete'];
        $bdd = connectBdd();
        $cmp = count($del);


        for ($i = 0; $i < $cmp; $i++) {
            $query = $bdd->query('DELETE FROM mail WHERE id = ' . $del[$i]);
        }
        header('location:mailbox.php?msg_deleted');

    } else {
        header('location:mailbox.php?error_deleted');
    }
} else {
    header('location:index.php');
    die();
}
?>