<?php
namespace App\Table\Exception;


use Throwable;

class NotFoundException extends \Exception {

    public function __construct(string $table, int $id)
    {
       $this->message = "Aucun enregistrement ne correspond a cette ID #$id dans la table '$table'";
    }

}