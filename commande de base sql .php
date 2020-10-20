<?php

$VARIABLECBDD = new PDO('mysql:host=mysql;dbname=xxxx;host=127.0.0.1', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

/*
$VARIABLECBDD = Nom de la variable pour la connexion à une base de donnée.
'mysql:host=mysql;dbname=basedetest;host=127.0.0.1', 'root', '' =
mysql = Utilisation de MySQL.
host=xxx = Nom de l'hôte hébergeant la BDD. (A CHANGER SI BESOIN).
dbname=xxxx = Nom de la base de donnée. (A CHANGER).
host=IP(xxx.xxx.xxx.xxx) = Ip de l'hébergeur de la BDD. (A CHANGER SI BESOIN).
'root' = Nom de compte de la BDD
'' = (Vide pour l'exemple = Mot de passe de la BDD)
[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] = Pour afficher les erreurs.
*/

$VARIABLENAME = $_POST["XXXX"];

/*
$VARIABLENAME = Variable qui indique ce que vaux ["XXXX"] qui entre en base de donnée
*/

$NOMVARIABLESQL = "INSERT INTO nomtable (colonne1, colonne2, colonne3) VALUES ('$VARIABLENAME', '$VARIABLENAME', '$VARIABLENAME')";

/*
$NOMVARIABLESQL = Nom de la variable pour une commande SQL.
"INSERT INTO" = Pour mettre des données dans une BDD.
"nomtable" = le nom de la table dans la quel nous voulons mettre des données.
(colonne1, 2, 3) = Dans quelle colonne nous voulons inscrire les données.
VALUES = Les valeurs à entrer dans la table.
('VARIABLENAME') = Les variables qui ont été renseigner avant avec =$_POST["XXXX"]
*/

$VALEUR = $VARIABLECBDD->query('SELECT * FROM nomtable ORDER BY id DESC');

/*
$VALEUR = Nom d'une variable pour démander l'éxécution d'une commande SQL par exemple.
$VARIABLECBDD = Nom de la variable pour la connexion à une base de donnée. (Dans se cas, pour indiquez une action sur la BDD donc se connecter pour effectuer l'action.)
->query = Exécute une requête SQL, retourne un jeu de résultats en tant qu'objet PDOStatement
'SELECT FROM nomtable' = Choisir dans la table xxxx, à savoir, entre 'SELECT et FROM' il est possible d'avoir plusieurs requête, par exemple ->
-> 'SELECT id FROM nomdetable' = Choisir (LES ID) dans la table xxxx.
-> 'SELECT name FROM nomdetable' = Choisir (LES NAME) dans la table xxxx.
ORDER BY = Par ordre (ID ou Date de création ou autre valeur)
DESC = Inverser l'ordre du tri.
*/

$VALEUR = $VARIABLECBDD->prepare("UPDATE nomtable SET title = '$title', content = '$content' WHERE id = '$id'");

/*
$VALEUR = Nom d'une variable pour démander l'éxécution d'une commande SQL par exemple.
$VARIABLECBDD = Nom de la variable pour la connexion à une base de donnée. (Dans se cas, pour indiquez une action sur la BDD donc se connecter pour effectuer l'action.)
->prepare = Prépare une requête à l'exécution et retourne un objet
"UPDATE nomtable" = Modification dans la table xxxx.
SET title = '$title', content = '$content' -- = Changer la variable '$title' et donc changer l'élément dans la BDD qui est dans la colonne "title"
WHERE = Permet d’extraire les lignes d’une base de données qui respectent une condition, en l'occurence la condition = ID.
*/

$VALEUR = $VARIABLECBDD->prepare("DELETE FROM nomtable WHERE id = $id ");

/*
$VALEUR = Nom d'une variable pour démander l'éxécution d'une commande SQL par exemple.
$VARIABLECBDD = Nom de la variable pour la connexion à une base de donnée. (Dans se cas, pour indiquez une action sur la BDD donc se connecter pour effectuer l'action.)
->prepare = Prépare une requête à l'exécution et retourne un objet
"DELETE FROM nomtable" = Supprimer depuis la table xxxx
WHERE = Permet d’extraire les lignes d’une base de données qui respectent une condition, en l'occurence la condition = ID.
*/