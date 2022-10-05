<?php

namespace App\Repositories;

use App\Models\Post;

class PostReponsitory {

    private $post = null;
    private static $posts = null;

    public function __construct( Post $post)
    {
        $this->post = $post;
        self::$posts = $post;
    }

    public function all() {
        return $this->post->all();
    }

    public function pagination( $number ) {
        return self::$posts->search()->paginate( $number );
    }

    public function create( $attributes ) {
        return $this->post::create( $attributes );
    }

    public function update ( $attributes , Post $post ) {
        return $post->update( $attributes );
    }
}

