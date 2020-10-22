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


/*if (isset($_GET['pays'])) {*/ 

    $reponse = $pdo->query('SELECT capitale FROM exo_pays');

    while ($donnees = $reponse->fetch())
    {
        echo $donnees['capitale'] . '<br />';
    }
    
    $reponse->closeCursor();
    
    
    /*$sql ="SELECT 'capitale = $capitale' FROM exo_pays WHERE 'pays' = $pays";
    var_dump($sql);
    var_dump('capitale');
    echo $capitale;
    $reponse = $pdo->query('SELECT capitale FROM exo_pays');
    var_dump($pdo);
    while($donnees = $reponse->fetch('capitale'))
    {
    /*$donnees = $reponse->fetch('capitale');
    var_dump($donnees);
    echo $donnees['capitale'];
    /*}*/

    $reponse->closeCursor();
    /*
    $sql = "INSERT INTO  () VALUES ('$', '$', )";
    

    var_dump($sql);
 
    
    $sql->execute() ;   

    echo "La capitale de $pays est ";*/



/*2. Avec la valeur $pays va selectionner dans ma bbd la capitale qui correspond a ce pays

Selectionne l'intituler de la conlone dans le nom de la tabble

 $req = $sql->prepare("SELECT 'pays','capitale' FROM exo_pays WHERE pays = $pays");

/*3. alors select capitale de pays -> WHERE Pays== $valuepays 


 (((ubdate for  exopays.php ..... where user ))))*/ 



/*
if ($_GET['pays'] === 'France'){
    echo "La capitale de la France est Paris";

} elseif ($_GET['pays'] === 'Angleterre'){
    echo "La capitale de l'Angleterre est Londres";

} elseif ($_GET['pays'] === 'Allemagne'){
    echo "La capitale de l'Allemagne est Berlin";}

    elseif ($_GET['pays'] === 'Espagne'){
        echo "La capitale de l'Espagne est Madrid";
        
    } else {
        echo '';
};*/


?>
</body>
</html>