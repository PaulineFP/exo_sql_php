<?php

//je charge le dossier d'autolaoding de composer: je remonte 2 crans en arriere, je vais dans le dossier vendor
// et je vais chercher le fichier autoload.php

require '../vendor/autoload.php';

//je démarre mon router

$router = new AltoRouter();

//ma constante, je lui donne les parametre de ma constante -> VIEW_PATH et je lui donne la valeur-> dossier courant.

define('VIEW_PATH', dirname(__DIR__) . '/views');


$router->map('GET','/projet', function () {
 require VIEW_PATH . '/post/index.php';
});

$router->map('GET','/projet/category', function () {
    require VIEW_PATH . '/category/show.php';
});

//je verifie si l'url correspond a une de ces routes

$match = $router->match();
//je recupere la fonction
$match['target']();