<?php
use App\Connection;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\CategoryValidator;
use App\ObjectHelper;
use App\Auth;

Auth::check();


$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$success = false;
$errors = [];
$fields = ['name', 'slug'];

if (!empty($_POST)) {
    $v = new CategoryValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, $fields);

    if ($v->validate()){
        $table->update([
                'name' => $item->getName(),
                'slug' => $item->getSlug()
        ], $item->getID());
        $success = true;
    } else{
       $errors = $v->errors();
    }
}

$form = new Form($item, $errors)

?>

<?php if ($success): ?>
<div class="alert alert-success">
    La catégorie à bien été modifiée
</div>
<?php endif ?>

<?php if (isset($_GET['created'])): ?>
    <div class="alert alert-success">
        La catégorie à bien été Crée
    </div>
<?php endif ?>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    La catégorie n'a pas pus être modifiée, merci de corriger vos erreurs
</div>
<?php endif ?>

<h1>Editer la catégorie <?= e($item->getName()) ?></h1>

<form action="" method="POST">
    <?= $form->input('name', 'Titre'); ?>
    <?= $form->input('slug', 'URL'); ?>
    <button class="btn btn-primary">Modifier</button>
</form>
