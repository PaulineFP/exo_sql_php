<?php

use App\Router;
require '../vendor/autoload.php';


define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/* J'ai passé un certain temps à gérer le contrôle des paramètres (afin de vérifier que ?page est bien un entier).
Afin de ne pas avoir à écrire cette logique encore et encore je vais créer une méthode statique qui me permettra
 d'obtenir facilement des paramètre "filtrés".

Aussi, je ne souhaite pas voir le paramètre ?page=1 dans l'URL (le paramètre est inutile et peut créer du duplicate).
Je gère donc cela dès l'entrée de mon application. */

if(isset($_GET['page']) && $_GET['page'] === '1') {
    // réécrire l'url sans le paramètre ?page
    $uri = $_SERVER['REQUEST_URI'];
    //je separe la partie qui contien les paramètres et la partie qui contien l'url
    $uri = explode('?', $uri)[0];
    $get =$_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if (!empty($query)){
        $uri = $uri . '?' . $query;
    }
    http_response_code(301);
    header('Location:' . $uri);
    exit;
}
//Ce code ci-dessus permet de mettre une contrainte globale sur toute l'application et permet d'éviter d'avoir à se soucier du problème par la suite.



//je charge le dossier d'autolaoding de composer: je remonte 2 crans en arriere, je vais dans le dossier vendor
// et je vais chercher le fichier autoload.php

//ma constante, je lui indique ce qu il doit chercher  dans le dossier courant '/view' et les actions a effectuer.

$router = new Router(dirname(__DIR__) . '/views');
$router
    ->get('/', 'post/index', 'home')
    ->get('/projet/category[*:slug]-[i:id]', 'category/show', 'category')
    ->get('/projet/[*:slug]-[i:id]', 'post/show','post')
    ->run();
?>

