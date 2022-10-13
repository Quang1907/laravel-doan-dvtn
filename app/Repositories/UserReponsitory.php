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

    public function findbyId( $id ) {
        return $this->user->where( "id", $id )->first();
    }

    public function findbySoftDelete( $id ) {
        return $this->user->onlyTrashed()->where( "id", $id )->first();
    }

    public function all() {
        return $this->user->search()->paginate( 5 );
    }

    public function whereManager( $field, $condition, $pagination = 5 ){
        return $this->user->search()->where( $field, $condition )->paginate( $pagination );
    }

    public function create( $attributes ) {
        return $this->user->create( $attributes );
    }

    public function update( $attributes, User $user ) {
        return $user->update( $attributes );
    }

    public function userSoftDelete( User $user ) {
        return $user->forceDelete();
    }

    public function userRestoreDelete( User $user ) {
        return $user->restore();
    }

}

