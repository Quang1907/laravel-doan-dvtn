<?php

namespace App\Repositories;

use App\Models\User;

class UserReponsitory {

    private $user = null;

    public function __construct( User $user)
    {
        $this->user = $user;
    }

    public function findbyEmail( $email ) {
        return $this->user->where( "email", $email )->first();
    }


    public function all() {
        return $this->user->all();
    }

    public function create( $attributes ) {
        return $this->user->create( $attributes );
    }

    public function update( $attributes, User $user ) {
        return $user->update( $attributes );
    }
}

