<?php
//connection à la base de donée
$pdo = new PDO('mysql:host=mysql;dbname=exo;host=127.0.0.1', 'root', 'toortoor', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

//if isset pour vérivié si il y a bien quantites en post car sinon il ne me le prennait pas en compte
if(isset($_POST['quantites']))
{

// crée mes variable en fonction des noms donnée en html

$article = $_POST['name'];
$ref = $_POST['ref'];
$nbr = intval($_POST['quantites']);


// puis je demande d'inséré les valeurs dans ma bdd

$sql =  "INSERT INTO form (nom_art, ref_art, quantite) VALUE ('$article', '$ref', '$nbr')";

$pdo->exec($sql);
}
// je le lie a mon dossier lister.php uniquement si quelque chose est inscrit dans name.
if (!empty($_POST['name'])){
    header('location: lister.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>

</head>

<body>

<h1 >Insérer un article dans la BDD</h1>

<form action="" method="POST">
    <input type="text" name="name" placeholder="Nom de l'article">

    <input type="text" name="ref"  placeholder="référence de l'article">

    <label for="tentacles">quantités:</label>

    <input type="number" id="tentacles" name="quantites"
           min="0" max="10">

    <button type="submit" >Envoyer a la base de donée</button>


</form>

</body>
</html>
