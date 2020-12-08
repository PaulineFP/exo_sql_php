<?php
use App\Connection;
use App\Table\PostTable;
use App\HTML\Form;
use App\Validators\PostValidator;
use App\ObjectHelper;




$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

$errors = [];

if (!empty($_POST)) {
    $v = new PostValidator($_POST, $postTable, $post->getID());
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at']);

    if ($v->validate()){
        $postTable->update($post);
        $success = true;
    } else{
       $errors = $v->errors();
    }
}

$form = new Form($post, $errors)

?>

<?php if ($success): ?>
<div class="alert alert-success">
    L'article <?= $post->getName() ?> à bien été modifié
</div>
<?php endif ?>

<?php if (isset($_GET['created'])): ?>
    <div class="alert alert-success">
        L'article <?= $post->getName() ?> à bien été Crée
    </div>
<?php endif ?>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    L'article n'a pas pus être modifié, merci de corriger vos erreurs
</div>
<?php endif ?>

<h1>Editer l'article <?= e($post->getName()) ?></h1>

<form action="" method="POST">
    <?= $form->input('name', 'Titre'); ?>
    <?= $form->input('slug', 'URL'); ?>
    <?= $form->textarea('content', 'Contenu'); ?>
    <?= $form->input('created_at', 'Date de publication'); ?>
    <button class="btn btn-primary">Modifier</button>
</form>
