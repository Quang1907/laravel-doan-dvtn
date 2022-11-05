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
        return $this->post->orderBy( "id", "DESC" )->search()->with( "categories" )->paginate( 5 );
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

    public function where( $field, $value, $condition = "") {
        if ( !empty( $condition ) ) {
            return $this->post->with( 'categories' )->where( $field, $condition, $value )->first();
        }
        return $this->post->with( 'categories' )->where( $field, $value )->first();
    }

    public function whereTitle( $field, $value ) {
        return $this->post->with( 'categories' )->where( $field, $value )->get();
    }

    public function orderByAndLimit( $orderBy = "ASC", $number = 10, $offset = 0,  $primary = "id" ) {
        return $this->post->orderBy( $primary, $orderBy )->limit( $number,  $offset )->get();
    }
}

