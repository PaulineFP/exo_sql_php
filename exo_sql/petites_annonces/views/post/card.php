<?php

/*Pour récupérer les catégories sur les cards de mes articles:
- Je crée un tableau contenant la syntaxe HTML d'un lien
[ '<a href="/category/123">Categorie</a>'
  '<a href="/category/123">Categorie</a>'
  '<a href="/category/123">Categorie</a>' ]
- Je regroupe les éléments du tableau avec une ,  */

$categories = [];
foreach($post->getCategories() as $category)
{
    $url = $router->url('category', ['id' => $category-> getID(), 'slug' => $category-> getSlug()]);
    $categories[] = <<<HTML
        <a href="{$url}">{$category->getName()}</a>
HTML;
}

/*  Autre solution pour simplifier le code si dessus:

    La fonction array_map ( Retourne un tableau contenant les résultats de l'application de la fonction de rappel callback à
l'index correspondant de array (et arrays si plus de tableaux sont fourni) utilisé en tant qu'arguments pour la fonction de rappel.
Le tableau retourné conservera les clés du tableau passé en argument, si et seulement si, un seul tableau est passé. Si plusieurs tableaux
sont passés comme argument, le tableau retourné aura des clés séquentielle sous la forme d'entier.)
 Elle s'écrie-> array_map ( callable $callback , array $array , array ...$arrays ) : array
ici:

$categories = array_map(function ($category) use ($router) {
    $url = $router->url('category', ['id' => $category-> getID(), 'slug' => $category-> getSlug()]);
    return <<<HTML
        <a href="{$url}">{$category->getName()}</a>
HTML;
}, $post->getCategories());  */

?>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
        <!--La méthode getCreatedAt() permet de récupérer un datetime, ce qui permet de formater facilement les dates:-->
        <p class="text-muted">
            <?= $post->getCreatedAt()->format('d F Y') ?>

            <?php if (!empty($post->getCategories())):?>
            :
            <?= implode(',', $categories) ?>
            <?php endif ?>

        </p>

        <p><?= $post->getExcerpt() ?></p>
        <p>
            <a href="<?= $router->url( 'post', ['id'=> $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir plus</a>
        </p>
    </div>
</div>