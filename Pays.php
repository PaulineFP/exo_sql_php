<?php
//Je me connecte a la BDD
//Crée une requete (query) pour  get toutes les capitals
//Executer la requette
//Afficher le resustat dans un foreach
//Soumettre (submit) le formulaire
//Recupperer la donnée en Get dans l'URL
//on stock la capitale dans une variable
//Préparer/Crée une requete pour chercher la capital qui corespond au pays
//Passer les paramètre à la requete
//Executer la requete
//Afficher le resultat
//------------------------------------------------------------------------------------------------------------------

//Je me connecte a la BDD
$pdo = new PDO('mysql:host=mysql;dbname=basedetest;host=127.0.0.1', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

//Crée une requete (query) pour  get toutes les capitals
$query = ("SELECT * FROM pays");

//Executer la requette
$capitals = $pdo->query("SELECT capital FROM pays")->fetchAll();

//execute la requete si il ya quelque chose dans la variable qui ressemble a capital dans l url
if(isset($_GET["capital"])){

//on stock la capitale dans une variable
    $getCapital = $_GET['capital'];


//Préparer/Crée une requete pour chercher la capital qui corespond au pays
    $sql = "SELECT country FROM pays WHERE capital = :capital";
    $prepare = $pdo->prepare("SELECT country FROM pays WHERE capital = :capital");
// ou $perpare = $pdo->prepare($sql);     


//Passer les paramètre à la requete
    $prepare->bindParam ('capital', $getCapital);

//Executer la requete
    $prepare->execute();

//Je stock dans une variable
    $country = $prepare->fetch();

//J'affiche le resultat
    $result= $country ["country"] . " a pour capitale $getCapital ." ;

}

?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="boostrap_decouvert.css">
    <title>Cours Pays/Capitale</title>
</head>

<body>

    <h1>Cours Pays/Capitale</h1>

<?php 
//je demmande si il ya dans la variable le resulta alors affiche y rien
if (isset($result)):?>
    <h1><?=$result ?></h1>
<?php else: ?>
    <h1>y a rien</h1>
<?php endif;
?>

    <form action="Pays.php" methode="get">

        <Select class= "form-control form-control-lg" name ='capital'>

            <option>Selectionner un pays</option>
    
                <?php //Afficher le resustat dans un foreach (je fait ma boucle)?>
                <?php foreach ($capitals as $capital ): ?>
                <option><?php echo $capital["capital"]?></option>
                <?php endforeach;?>

        </Select>

        <?php //Soumettre (submit) le formulaire?>
        <button type="submit" class="btn btn-primary btn-lg">Submit</button> 

    </form>

</body>
</html>