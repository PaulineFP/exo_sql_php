<?php
namespace App\Validators;

use App\Table\CategoryTable;

Class CategoryValidator extends AbstractValidator {

    public function __Construct(array $data, CategoryTable $table, ?int $id = null)
    {
        parent::__Construct($data);
        $this->validator->rule('required', ['name','slug']);
        $this->validator->rule('lengthBetween', ['name', 'slug'], 3,200);
        $this->validator->rule('slug', 'slug');

        $this->validator->rule(function ($field, $value) use ($table, $id) {
            return !$table->exists($field, $value, $id);
        }, ['slug','name'], 'Ce valeur est déjà utilisée.');
    }

}