<?php

namespace App\Validators;

use App\Validator;

 abstract class AbstractValidator {

     //Des qu on utilise des valeurs privées dans les enfants il ne faut pas oublier de les passer et protégées.
    protected $data;
    protected $validator;

    public function __Construct(array $data)
    {
        $this->data = $data;
        $this->validator = new Validator($data);
    }

    public function validate(): bool
    {
        return $this->validator->validate();
    }

    public function errors(): array
    {
        return $this->validator->errors();
    }


}