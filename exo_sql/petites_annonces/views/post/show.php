<?php
use App\Connection;
use App\Model\{Post,Category};

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query = $pdo->prepare("SELECT * FROM post WHERE id = :id ");
$query->execute(['id'=>$id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
//Je met un comantaire pour aider mon editeur a mieux comprendre pour que par la suite il puisse me dire que la methode getSlug existe bien sur ce type la.
/** @var Post | false*/
$post = $query->fetch();

if($post === false){
    throw new Exception('Aucun article ne correspond a cette ID');
}

if($post->getSlug() !== $slug){
    $url = $router->url('post', ['slug'=> $post->getSlug(), 'id' => $id]);
    //si l'url n'est pas bon
    http_response_code(301);
    header('Location:' . $url);
}

$query = $pdo->prepare("
        SELECT c.id, c.slug, c.name
        FROM post_category pc
        JOIN category c ON pc.category_id = c.id
        WHERE pc.post_id = :id ");
$query->execute(['id'=> $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, \App\Model\Category::class);
/** @var Category[]*/
$categories = $query->fetchAll();
/*-----------------------------------------------------------------------------------------------------------------*/
?>

<h1><?= e($post->getName()) ?></h1>
    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
    <!--$k pour metre ma condition dans le but d'insérer une virgule-->
    <?php foreach ($categories as $K=> $category):
        if ($K >0):
        echo ',';
        endif;
        $category_url = $router->url('category', ['id' => $category-> getID(), 'slug' => $category-> getSlug()])?>
        <a href="<?= $category_url ?>"><?= e($category->getName())
        ?></a>
    <?php endforeach; ?>
    <p><?= $post->getFormattedContent() ?></p>
