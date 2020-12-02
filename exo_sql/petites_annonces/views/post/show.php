<?php
use App\Connection;
use App\Table\{PostTable,CategoryTable};


$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$post = (new PostTable($pdo))->find($id);
(new CategoryTable($pdo))->hydratePosts([$post]);

if($post->getSlug() !== $slug){
    $url = $router->url('post', ['slug'=> $post->getSlug(), 'id' => $id]);
    //si l'url n'est pas bon
    http_response_code(301);
    header('Location:' . $url);
}

/*-----------------------------------------------------------------------------------------------------------------*/
?>

<h1><?= e($post->getName()) ?></h1>
    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
    <!--$k pour metre ma condition dans le but d'insérer une virgule-->
    <?php foreach ($post->getCategories() as $K=> $category):
        if ($K >0):
        echo ',';
        endif;
        $category_url = $router->url('category', ['id' => $category-> getID(), 'slug' => $category-> getSlug()])?>
        <a href="<?= $category_url ?>"><?= e($category->getName())
        ?></a>
    <?php endforeach; ?>
    <p><?= $post->getFormattedContent() ?></p>
