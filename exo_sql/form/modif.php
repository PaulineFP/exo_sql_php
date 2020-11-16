<?php
//connection à la base de donée
$pdo = new PDO('mysql:host=mysql;dbname=exo;host=127.0.0.1', 'root', 'toortoor', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// lui imposer l action modifer par une reconnaissance dans l'url
$ins = $pdo->prepare("SELECT * FROM form WHERE id = :num");
$ins->bindParam(":num", $_GET["lign_update"]);
$ins->execute();

$ins->fetch();



//je met une condition en recupérant mes variables en post

if(isset($_POST['name']) && !empty($_POST['name'])
&& isset($_POST['ref']) && !empty($_POST['ref'])
&& isset($_POST['quantites']) && !empty($_POST['quantites']))

{


//je declare la variable id en fonction de se que j ai récupéré en get

    $id = $_GET["lign_update"];




//j'indique les variable par rapport a ce que j ai recup en post nom,ref,quantites

    $article = $_POST['name'];
    $ref = $_POST['ref'];
    $nbr = intval($_POST['quantites']);

//je crée une requette sql en assignant les nouvelles valeurs dans ma table

    $req = $pdo->prepare("UPDATE form SET nom_art ='$article', ref_art = '$ref', quantite ='$nbr'WHERE id ='$id'");


//j'éxecute

    $req->execute();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>

</head>

<body>

<h1 >Modifier un article de la BDD</h1>

<form action="" method="POST">
    <input type="text" name="name" placeholder="Nom de l'article">

    <input type="text" name="ref"  placeholder="référence de l'article">

    <label for="tentacles">quantités:</label>

    <input type="number" id="tentacles" name="quantites"
           min="0" max="10">

    <button type="submit" name="lign_update" >Modifier</button>


</form>

</body>
</html>

