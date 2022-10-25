<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                "name" => "Trang chủ",
                "slug" => "/",
                "description" => "Trang chu",
                "parent_id" => null,
                "image" => null,
                "meta_title" => "Trang chủ",
                "meta_keyword" => "Đoàn viên thanh niên",
                "meta_description" => "Đoàn viên thanh niên",
            ],
            [
                "name" => "Cửa hàng",
                "slug" => Str::slug( "Cửa hàng" ),
                "parent_id" => null,
                "description" => "Cửa hàng",
                "image" => null,
                "meta_title" => "Trang chủ",
                "meta_keyword" => "Đoàn viên thanh niên",
                "meta_description" => "Đoàn viên thanh niên",
            ],
            [
                "name" => "Hoạt động",
                "slug" => Str::slug( "Hoạt động" ),
                "parent_id" => null,
                "description" => "Hoạt động",
                "image" => null,
                "meta_title" => "Trang chủ",
                "meta_keyword" => "Đoàn viên thanh niên",
                "meta_description" => "Đoàn viên thanh niên",
            ],
        ];

        foreach ( $categories as $category ) {
            Category::create( $category );
        }
    }
}
