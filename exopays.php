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
</body>
</html>
<?php


$pdoStat = $pdo->query ("SELECT * FROM exo_pays");

if (isset($_GET['pays']))
{ 
     // Je recupere le ville qui est dans l'url
    $pays = $_GET['pays'];
    // Je créer ma requte SQL
    $sql = $pdo->prepare("SELECT pays FROM exo_pays WHERE capitale = :capitale");
    var_dump($pdo);
     // Je lui passe le param's:
    // https://www.php.net/manual/fr/pdostatement.bindparam.php
    $sql->bindParam(":capitale", $pays) ;
    // j'execute
    $sql->execute();
    $contry = $fetch['capitale'];
    echo "L'$pays a pour capital $country";

}

$pays = $pdoStat->fetchAll();

    /* boucle de marika permettant de conserver la selection dans le menu :

    <option value= "<?php echo $ $item [ville];"

    if (isset ($_GET["ville"]) && $ville == $item ["ville"])
    {
        echo "selected";
    } */
 ?>