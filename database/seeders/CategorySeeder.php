<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

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
                "parent_id" => null,
            ],
            [
                "name" => "Cửa hàng",
                "slug" => "cua-hang",
                "parent_id" => null,
            ],
            [
                "name" => "Hoạt động",
                "slug" => "hoat-dong",
                "parent_id" => null,
            ],
        ];

        foreach ( $categories as $category ) {
            Category::create( $category );
        }
    }
}
