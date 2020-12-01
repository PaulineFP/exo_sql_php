<?php
use App\Router;
use App\Helpers\Text;
use App\Model\{Post,Category};
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

//Je crée le tableau des articles indexer par les id et je remplis par les catégories:
$postsByID = [];
foreach ( $posts as $post){
    $postsByID [$post->getID()] = $post;
    $ids[] = $post->getID();
}

/*  Pour obtenir la liste d id a partir de mon tableau, j'utilise la fonction implode.
    Elle permet de prendre un tableau et d'en générer une chaine de caractères */
$categories = $pdo->query('SELECT  c.*, pc.post_id
                        FROM post_category pc
                        JOIN category c ON c.id = pc.category_id
                      
                        WHERE pc.post_id IN ('. implode(',', array_keys($postsByID)) . ')')
                        ->fetchAll(PDO::FETCH_CLASS,Category::Class);

/*Pour faire la liaison entre les catégories et le tableau des articles:
- Je parcourts les catégories
- Pour chaque catégorie, je trouve l'article $post correspondant a la ligne
- J'ajoute la catégorie à l'article
*/

foreach ($categories as $category){
        $postsByID[$category->getPostID()]->addCategory($category);
        }

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
