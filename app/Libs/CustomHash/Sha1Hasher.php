<?php
namespace App\Libs\CustomHash;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Hashing\AbstractHasher;

class Sha1Hasher extends AbstractHasher implements Hasher {

    public function make( $value, array $options = array() ) {

        return sha1( $value );
    }

    public function check( $value, $hashedValue, array $options = array() ) {
        return $this->make( $value ) === $hashedValue;
    }

    public function needsRehash( $hashedValue, array $options = array() ) {
        return false;
    }

}
