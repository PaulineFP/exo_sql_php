<?php

$pdo = new PDO('mysql:host=mysql;dbname=basedetest;host=127.0.0.1', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

$pdoStat = $pdo->prepare("SELECT * FROM exo_pays");

$pdoStat->execute();

/*Resultat*/

$pays = $pdoStat->fetchAll();


?>

<!doctype html>
<html lang="fr-fr">

<head>
    <link rel="stylesheet" href="boostrap_decouvert.css">
    <meta charset="utf-8">
    <title>Liste déroulante</title>
</head>

<body>

<form method="GET" action="exopays.php">

    <select class="custom-select" name="pays">
        <option selected="selected">Sélectionner un pays</option>

        <?php foreach ($pays as $value): ?>

            <option <?= $value['pays']; ?>><?= $value['pays']; ?></option>

        <?php endforeach; ?>

    </select>

    <input type="submit"> </input>

</form>

<?php

$pays = $_GET['pays'];
var_dump($pays);



/*récupérer dans la BDD le nom du pays associé à la $ville envoyée
stocker dans une variable le nom du $pays
afficher une phrase avec le nom de la ville + le nom du pays*/

/*1. si il y a quelque chose dans la varible entre parentese alors execute l'action de l'accolade*/



/*C EST UNE HISTOIRE DE BOUCLE JUSTE TROUVER OU L ARRETER*/

if (isset($_GET['pays'])) {

    $reponse = $pdo->query('SELECT capitale FROM exo_pays');}

    while ($donnees = $reponse->fetch())
    {
        echo $donnees['capitale'] . '<br />';
    }
    
    $reponse->closeCursor();
    
    
    


?>
</body>
</html>