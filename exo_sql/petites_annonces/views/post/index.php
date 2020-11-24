<?php
use App\Router;

use App\Helpers\Text;
use App\Model\Post;


$title = 'Mon projet';

$pdo = new PDO('mysql:dbname=projetPA;host=127.0.0.1', 'root', 'toortoor', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

/* Pour mettre en place la pagination. Il va falloir calculer les variables suivantes :

   - Le nombre total d'articles (une requête SQL avec un COUNT(id)).
   - Le nombre d'articles par page (on peut définir une variable ou utiliser une constante).
   - Le nombre de pages (obtenu en divisant le nombre total d'articles par le nombre d'éléments par page).

Il suffit ensuite de jouer avec le paramètre OFFSET afin d'afficher les articles correspondant à une certaine page. */

$page = ($_GET['page'] ?? 1);
//pour filtrer l'url.
if (!filter_var($page, FILTER_VALIDATE_INT)){
    throw new Exception('Numéro de page invalide');
}

if($page === '1'){
    header('Location:' . $router->url('home'));
    http_response_code(301);
    exit();
}

$currentPage = (int)$page;

if ($currentPage <= 0){
    throw new Exception('Numéro de page invalide');
}
$count= (int)$pdo->query("SELECT COUNT(id) FROM post")->fetch(PDO::FETCH_NUM)[0];

$perPage = 12;

$pages = ceil($count / $perPage);

if ($currentPage > $pages){
    throw new Exception('Cette page n\'existe pas');
}

$offset = $perPage * ($currentPage-1);
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");

$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
?>

<h1 >Mon projet</h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
        <div class="col-md-3">
            <?php require 'card.php' ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="d-flex justify-content-between my-4">

    <?php if ($currentPage > 1): ?>
        <?php
        $link = $router->url('home');
        if ($currentPage > 2) $link .= '?page=' . ($currentPage -1);
        ?>
        <a href="<?= $link ?>" class="btn btn-primary">&laquo; Page précédente</a>
    <?php endif;?>

    <?php if ($currentPage < $pages): ?>
        <a href="<?= $router->url('home') ?>?page=<?= ($currentPage +1 )?>" class="btn btn-primary ml-auto">Page suivante &raquo;</a>
    <?php endif;?>
</div>
