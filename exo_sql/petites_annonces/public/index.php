<?php

use App\Router;
require '../vendor/autoload.php';


define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

//je charge le dossier d'autolaoding de composer: je remonte 2 crans en arriere, je vais dans le dossier vendor
// et je vais chercher le fichier autoload.php


//ma constante, je lui indique ce qu il doit chercher  dans le dossier courant '/view' et les actions a effectuer.

$router = new Router(dirname(__DIR__) . '/views');
$router
    ->get('/projet', 'post/index', 'projet')
    ->get('/projet/category', 'category/show', 'category')
    ->run();
?>