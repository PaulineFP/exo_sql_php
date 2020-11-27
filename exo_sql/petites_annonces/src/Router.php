<?php

//je met ma classe dans un namespace particulier pour evité de la mélanger avec d'autre apli.
namespace App;
use AltoRouter;
class Router{

    //pour pouvoir  acceder a ma varaible 'viewpath' dans les autres methodes, je crée une porpriété de type chaine de caractere 'string'.
    private $viewPath;

    //la fonction si dessous a besoin d'altorouteur pour fonctionner, je lui crée une variable.
    private $router;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        //je definis routeur
        $this->router = new AltoRouter();
    }

    //j indique les paramètre a ma constante avec les nouvelles methodes
    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);
        //je renvoie l'obj en cours pour pas redéfinir la variable
        return $this;
    }

    public function url (string $name, array $params =[])
    {
        return $this->router->generate($name, $params);
    }
//je verifie si l'url correspond a une de ces routes

    public function run(): self
    {
       $match = $this->router->match();
        //je recupere la fonction tamplate
       $view = $match['target'];
       $params = $match['params'];
       $router = $this;
       ob_start();
       require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
       $content = ob_get_clean();
       require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/default.php';
       return $this;
    }
}

?>
