<?php
namespace App\Table;

use App\PaginatedQuery;
use App\Model\Post;
use PDO;


final class PostTable extends TableParent {

    // Je rappelle mes valeurs protégé de la table Parent.
    protected $table = "post";
    protected $class = Post::class;

    public function update(Post $post): void
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name =  :name, slug = :slug, created_at = :created_at, content = :content WHERE id = :id");
        $ok = $query->execute([
            'id' => $post->getID(),
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:i')
        ]);
        if($ok === false){
            throw new \Exception("Impossible de modifier l'enregistrement $id dans la table {$this->table}");
        }
    }
    public function create(Post $post): void
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name =  :name, slug = :slug, created_at = :created_at, content = :content ");
        $ok = $query->execute([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:i')
        ]);
        if($ok === false){
            throw new \Exception("Impossible de crée l'enregistrement $id dans la table {$this->table}");
        }
        $post->setID($this->pdo->lastInsertId());
    }

    public function delete (int $id): void
    {
            $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
            $ok = $query->execute([$id]);
            if($ok === false){
                throw new \Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
            }
    }

    /* Pour mettre en place la pagination si dessous. Il va falloir calculer les variables suivantes :

              - Le nombre total d'articles (une requête SQL avec un COUNT(id)).
              - Le nombre d'articles par page (on peut définir une variable ou utiliser une constante).
              - Le nombre de pages (obtenu en divisant le nombre total d'articles par le nombre d'éléments par page).

           Il suffit ensuite de jouer avec le paramètre OFFSET afin d'afficher les articles correspondant à une certaine page. */

    public function findPaginated()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC ",
            "SELECT COUNT(id) FROM {$this->table}");
        $this->pdo;
        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }

    public function findPaginatedForCategory (int $categoryID)
    {

        $paginatedQuery = new PaginatedQuery(
            "SELECT p.*
            FROM post p
            JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = {$categoryID}
            ORDER BY created_at DESC",
            "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$categoryID}"
        );

        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }


    /**
     * Vérifie si une valeur existe dans la table:
     *
     * @param string $field Champ à rechercher
     * @param mixed $value Valeur associée au champs
     */
    public function exists (string $field, $value, ?int $except = null): bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} WHERE $field = ?";
        $params = [$value];
        if ($except !== null){
            $sql .= "AND id != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0 ;
    }
}