<?php
namespace App\Table;

use App\Model\Category;
use App\PaginatedQuery;
use \PDO;

 final class CategoryTable extends TableParent {

    protected $table = "category";
    protected $class = Category::class;




    /**
    * @param App\Model\Post[] $posts
     */
    public function hydratePosts (array $posts): void
    {
    //Je crée le tableau des articles indexer par les id et je remplis par les catégories:
    $postsByID = [];
    foreach ( $posts as $post){
        //initialise à chaque hydratation
        $post->setCategories([]);
        $postsByID [$post->getID()] = $post;
        $ids[] = $post->getID();
    }

    /*  Pour obtenir la liste d id a partir de mon tableau, j'utilise la fonction implode.
        Elle permet de prendre un tableau et d'en générer une chaine de caractères */
    $categories = $this->pdo->query('SELECT  c.*, pc.post_id
                    FROM post_category pc
                    JOIN category c ON c.id = pc.category_id
                    WHERE pc.post_id IN ('. implode(',', array_keys($postsByID)) . ')')
        ->fetchAll(PDO::FETCH_CLASS,$this->class);

    /*Pour faire la liaison entre les catégories et le tableau des articles:
    - Je parcourts les catégories
    - Pour chaque catégorie, je trouve l'article $post correspondant a la ligne
    - J'ajoute la catégorie à l'article */

    foreach ($categories as $category){
            $postsByID[$category->getPostID()]->addCategory($category);
        }
    }

    public function all (): array
     {
        return $this->queryAndFetchAll("SELECT * FROM {$this->table} ORDER BY id DESC ");
     }

   public function list(): array
   {
       $categories = $this->queryAndFetchAll("SELECT * FROM {$this->table} ORDER BY name ASC");
       $results = [];
       foreach ($categories as $category){
           $results[$category->getID()] = $category->getName();
       }
       return $results;

   }


 }