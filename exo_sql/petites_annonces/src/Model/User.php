<?php
namespace App\Model;

class User{

    /**
     * @var int
     */
    private $id;

    /**
    * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }



    public function getPassword(): ?string
    {
        return $this->password;
    }


    public function setPassword(string $password): self
    {
        $this->password = $password;
    }


}