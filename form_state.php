<?php
require_once 'fonction.php';
if (isConnected()) {
    if (isset($_GET['state'])) {
        $st = $_GET['state'];
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            switch ($st) {
                case 'free':
                    if (isset($_POST['true'])) {
                        $true = $_POST['true'];
                        if ($true == "OUI") {
                            changestatefree($id);
                            header('location:room.php');
                            die();
                        } else {
                            header('location:page_404.php');
                            die();
                        }
                    } else {
                        header('location:page_404.php');
                        die();
                    }
                    break;
                case 'occuped':
                    if (!empty($_POST['nom']) && !empty($_POST['prenom'])) {
                        $nom = htmlspecialchars(trim($_POST['nom']));
                        $prenom = htmlspecialchars(trim($_POST['prenom']));

                        if (strlen($nom) < 2 && strlen($prenom) < 2) {
                            header('location:roomstate.php?id=' . $id . '&etat=0&error');
                            die();
                        } else {
                            changestateoccuped($id, $nom, $prenom);
                            header('location:room.php');
                            die();
                        }
                    } else {
                        header('location:roomstate.php?id=' . $id . '&etat=0&error');
                        die();
                    }
                    break;
                case 'clear':
                    if (isset($_POST['true'])) {
                        $true = $_POST['true'];
                        if ($true == "OUI") {
                            changestateclear($id);
                            header('location:room.php');
                            die();
                        } else {
                            header('location:page_404.php');
                            die();
                        }
                    } else {
                        header('location:page_404.php');
                        die();
                    }
                    break;
                case 'disable':
                    if (isset($_POST['msg'])) {
                        $msg = htmlspecialchars(trim($_POST['msg']));
                        if (empty($msg)) {
                            $msg = NULL;
                        }
                        changestatedisable($id, $msg);
                        header('location:room.php');
                        die();
                    } else {
                        header('location:page_404.php');
                        die();
                    }
                    break;
                default:
                    header('location:page_404.php');
                    break;
            }
        } else {
            header('location:page_404.php');
            die();
        }
    } else {
        header('location:page_404.php');
        die();
    }
} else {
    header('location:index.php');
    die();
}