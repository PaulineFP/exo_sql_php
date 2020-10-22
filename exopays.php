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

$pays = $_GET['pays'];
var_dump($pays);



/*récupérer dans la BDD le nom du pays associé à la $ville envoyée
stocker dans une variable le nom du $pays
afficher une phrase avec le nom de la ville + le nom du pays

1. si il y a quelque chose dans la varible entre parentese alors execute l'action de l'accolade



C EST UNE HISTOIRE DE BOUCLE JUSTE TROUVER OU L ARRETER

tu lui demande de te sortir que la valeur d une seule colonne je dirai c est la correspondance qui va pas

oui je pense que c,'est la même boucle qu'hier mais au lieu de définir 
chaque condition à la main et écrire un echo il faut y coller des requêtes sql pour que ça ailler chercher 
le bon élément dans la base de données*/ 

if (isset($_GET['pays']))
{ 
    $reponse = $pdo->prepare("SELECT capitale, pays FROM exo_pays WHERE  capitale <capitale AND pays = :pays");
    var_dump($reponse);
    $reponse->bindParam("':pays', $pays PDO::PARAM_STR") ;
    $reponse->bindParam("':capitale', $capitale PDO::PARAM_STR");
  /*  $req->execute(); 
    $reponse->fetch();*/
    var_dump($reponse);
}

/*alors affiche moi la capitale qui correspond au pays*/

 
while ($donnees = $reponse->fetch())
{
echo $donnees['capitale'];

$reponse->closeCursor();
}

    /* boucle de marika permettant de conserver la selection dans le menu :

    <option value= "<?php echo $ $item [ville];"

    if (isset ($_GET["ville"]) && $ville == $item ["ville"])
    {
        echo "selected";
    } */
 ?>