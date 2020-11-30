<?php
use App\Router;
use App\Helpers\Text;
use App\Model\Post;
use App\Connection;
use App\URL;
use App\PaginatedQuery;


$title = 'Mon projet';

$pdo = Connection::getPDO();

/* Pour mettre en place la pagination. Il va falloir calculer les variables suivantes :

   - Le nombre total d'articles (une requête SQL avec un COUNT(id)).
   - Le nombre d'articles par page (on peut définir une variable ou utiliser une constante).
   - Le nombre de pages (obtenu en divisant le nombre total d'articles par le nombre d'éléments par page).

Il suffit ensuite de jouer avec le paramètre OFFSET afin d'afficher les articles correspondant à une certaine page. */
$paginatedQuery = new \App\PaginatedQuery(
       "SELECT * FROM post ORDER BY created_at DESC ",
    "SELECT COUNT(id) FROM post");
$posts = $paginatedQuery->getItems(Post::class);
$link = $router->url('home');
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
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
</div>
