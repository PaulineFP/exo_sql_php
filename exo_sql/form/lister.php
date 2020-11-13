<?php
//connection à la base de donée
$pdo = new PDO('mysql:host=mysql;dbname=exo;host=127.0.0.1', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);


// je prépare ma requette en lui indiquant les selections

$pdoStat = $pdo->query('SELECT * FROM form');


//j'affiche tout

$from = $pdoStat->fetchAll();


?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>

    </head>
<body>
<?php foreach ($from as $items): ?>

<p> 'L\'article'</p>

    <p><?php echo  $items['nom_art'];?>.' qui a pour référence '.</p>

    <p><?php echo $items['ref_art']; ?>.' est en '.</p>

<p><?php echo $items['quantite']; ?>.' exemplaire '.</p>';



<?php endforeach; ?>
</body>
</html>
