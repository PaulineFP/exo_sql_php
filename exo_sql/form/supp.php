<?php
//connection à la base de donée
$pdo = new PDO('mysql:host=mysql;dbname=exo;host=127.0.0.1', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
