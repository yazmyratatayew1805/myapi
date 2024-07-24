<?php

namespace App\Model;

class User {
    public $id;
    public $username;
    public $password;
    public $email;
    public $created_at;

    public function __construct($id, $username, $password, $email, $created_at) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->created_at = $created_at;
    }
}
