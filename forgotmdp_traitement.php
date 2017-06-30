<?php
require_once "fonction.php";

if(!empty($_POST['mail'])) {
    $mail = $_POST['mail'];

    if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
        if($res = emailExist($mail)){
            $cle = randomCle(32);
            forgotMdp($cle,$res['id']);
            mailMdp($mail,$cle);
            header('location:index.php');
        }else{
            header('location:forgotmdp.php?not_found');
        }
    }else{
        header('location:forgotmdp.php?empty_field');
    }

}else{
    header('location:forgotmdp.php?empty_field');
}