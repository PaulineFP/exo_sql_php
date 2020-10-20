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
};
?>
</body>
</html>