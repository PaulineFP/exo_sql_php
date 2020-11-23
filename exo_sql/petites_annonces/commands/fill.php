<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

$pdo = new PDO('mysql:dbname=projetPA;host=127.0.0.1', 'root', 'toortoor', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

/* Je remplis ma base de données avec des données de tests et vu que je vais créer un script que
je pourrais appeler pour remplir instantanément la base avec des dixaines de contenus.*/

//Je commence par complètement vider la base de données :

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

// J'enregistre les ids des contenus créés
$posts = [];
$categories = [];

/*Pour remplir la base on peut générer des titres à la main en se basant sur l'index de notre boucle ou se baser sur une
librairies comme faker afin d'avoir des données plus "réalistes".*/

for ($i = 0; $i < 30; $i++) {
    $pdo->exec("INSERT INTO post SET name='{$faker->sentence()}', slug='{$faker->slug}', created_at='{$faker->date()} {$faker->time()}', content='{$faker->paragraphs(rand(3,15), true)}'");
    $posts[] = $pdo->lastInsertId();
}

for ($i = 0; $i < 8; $i++) {
    $pdo->exec("INSERT INTO category SET name= '{$faker->sentence(3)}', slug= '{$faker->slug}' ");
    $categories[] = $pdo->lastInsertId();
}

// J'associe aléatoirement des articles à des catégories
foreach ($posts as $post) {
    $randomCategories = $faker->randomElements($categories, rand(0, count($categories)));
    foreach ($randomCategories as $category) {
        $pdo->exec("INSERT INTO post_category SET post_id=$post, category_id=$category");
    }
}

$password = password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET username='admin' , lastname='admin' , telephone='0680543971' , mail='ggggg@gmail.com' , password='$password'");

//Ce code permet de créer 30 articles et 8 catégories en une seule fois.