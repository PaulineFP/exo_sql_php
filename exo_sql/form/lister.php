<?php
//connection à la base de donée
$pdo = new PDO('mysql:host=mysql;dbname=exo;host=127.0.0.1', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);


// je prépare ma requette en lui indiquant les selections

$pdoStat = $pdo->query('SELECT * FROM form');


//j'affiche tout avec un bouton pour supprimer dans la bdd et modifier

$from = $pdoStat->fetchAll();


?>
    <!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>

    </head>
<br>
<?php foreach ($from as $items): ?>

<p> L'article <?php echo  $items['nom_art'];?> qui a pour référence <?php echo $items['ref_art']; ?> est en <?php echo $items['quantite']; ?> exemplaire(s) </p>

    <a class="delete" href="supp.php?lign_delete=<?= intval($items['id']) ?> ">Supprimer l'article de la base de donnée </a>
</br>
    <a  class="update" href="modif.php?lign_update=<?= intval($items['id']) ?> ">modifier l'article</a>

<?php endforeach; ?>
</body>
</html>
