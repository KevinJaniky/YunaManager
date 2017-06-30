<?php
require_once "fonction.php";

    changeStateDisconnect($_SESSION['id']);
    session_destroy();
    header('location:index.php?disconnected');
    die();


