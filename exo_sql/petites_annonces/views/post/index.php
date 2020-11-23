<?php
use App\Router;
require '../vendor/autoload.php';
use App\Helpers\Text;
use App\Model\Post;


$title = 'Mon projet';

$pdo = new PDO('mysql:dbname=projetPA;host=127.0.0.1', 'root', 'toortoor', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT 12 ");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
?>

<h1>Mon projet</h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
    <div class="col-md-3">
     <?= require 'card.php' ?>
    </div>
    <?php endforeach ?>
</div>
