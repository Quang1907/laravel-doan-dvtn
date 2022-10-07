<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                "name" => "manage_user"
            ],
            [
                "name" => "manage_item"
            ],
            [
                "name" => "view_item"
            ],
        ];

        foreach ( $permissions as $permission ) {
            Permission::create( $permission );
        }
    }
}
