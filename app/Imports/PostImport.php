<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class PostImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading, WithProgressBar, WithBatchInserts
{
    use Importable, Batchable, RemembersChunkOffset;

    public function model( array $row ) {
        return new Post([
            "title" => $row[ "title" ],
            "content" => $row[ "content" ],
        ]);

        // $categoryName = explode( "," ,  $row['category'] );
        // $categoryArr = array();

        // foreach ( $categoryName as $category ) {
        //     $cate = Category::where( "name", "like", "%" . trim( $category ). "%" )->first();
        //     if ( !empty( $cate ) ) {
        //        array_push( $categoryArr, $cate->id );
        //     }
        // }

        // $post->categories()->sync(  $categoryArr );
    }

    public function chunkSize(): int
    {
        return 10002;
    }

    public function batchSize(): int
    {
        return 10000;
    }
}
