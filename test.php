<?php
require 'fonction.php';
$bdd =connectBdd();

$req = $bdd->query('SELECT * FROM chambre WHERE etat = 2 ');
$data = $req->fetchAll();

print_r($data);