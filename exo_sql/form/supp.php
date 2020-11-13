<?php

//connection à la base de donée
$pdo = new PDO('mysql:host=mysql;dbname=exo;host=127.0.0.1', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

//je lui indique la référance et son appartenant

$id = $_REQUEST["lign_delete"];

$id = intval($id);

//je crée une requette sql pour suprimer

$req = $pdo->prepare("DELETE FROM form WHERE id = $id ");

//j'execute
$req->execute();

?>