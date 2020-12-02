<?php
namespace App\Table;

use \PDO;

abstract class TableParent{

    protected $pdo;

    //pour éviter de devoir changer les propriétées (category et post) de la fonction find, je met les valeurs en protegé.
    protected $table = null;
    protected $class = null;

    public function __construct(PDO $pdo)
    {
        if ($this->table === null){
            throw new \Exception("la classe ". get_class($this) ." n'a pas de propriété \$table");
        }
        if ($this->class === null){
            throw new \Exception("la classe ". get_class($this) ." n'a pas de propriété \$class");
        }

        $this->pdo = $pdo;
    }

    public function find (int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table  . ' WHERE id = :id ');
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if ($result === false) {
            throw new NotFoundException($this->table, $id);
        }
        return $result;
    }
}