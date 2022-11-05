<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class PostImport implements ToCollection, WithHeadingRow, ShouldQueue, WithChunkReading, WithProgressBar, WithBatchInserts
{
    use Importable, Batchable, RemembersChunkOffset;

    // protected $user = null;

    // public function  __construct( User $user )
    // {
    //     $this->user = $user;
    // }

    public function collection( Collection $rows ) {
        foreach ( $rows as $post ) {
            Post::create([
                "title" => $post[ "title" ],
                "slug" => Str::slug( $post[ 'title' ] ),
                "content" => $post[ "content" ],
                "image" => "16667002584ong-ho-tan-minh-chanh-van-phong-so-giao-duc-dao-tao-1-6482.jpg",
                "user_id" => 1,
            ]);
        }
    }

    // public function model( array $row ) {
    //     return new Post([
    //         "title" => $row[ "title" ],
    //         "slug" => Str::slug( $row[ 'title' ] ),
    //         "content" => $row[ "content" ],
    //         "image" => "16667002584ong-ho-tan-minh-chanh-van-phong-so-giao-duc-dao-tao-1-6482.jpg",
    //         "user_id" => auth()->user()->id,
    //     ]);

    //     // $categoryName = explode( "," ,  $row['category'] );
    //     // $categoryArr = array();

    //     // foreach ( $categoryName as $category ) {
    //     //     $cate = Category::where( "name", "like", "%" . trim( $category ). "%" )->first();
    //     //     if ( !empty( $cate ) ) {
    //     //        array_push( $categoryArr, $cate->id );
    //     //     }
    //     // }

    //     // $post->categories()->sync(  $categoryArr );
    // }

    public function chunkSize(): int
    {
        return 10002;
    }

    public function batchSize(): int
    {
        return 10000;
    }
}
