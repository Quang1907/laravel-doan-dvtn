<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolePermissions = [
            [
                "role_id" => 1,
                "permission_id" => 1
            ],
            [
                "role_id" => 1,
                "permission_id" => 2
            ],
            [
                "role_id" => 1,
                "permission_id" => 3
            ],
            [
                "role_id" => 2,
                "permission_id" => 2
            ],
            [
                "role_id" => 2,
                "permission_id" => 3
            ],
            [
                "role_id" => 3,
                "permission_id" => 3
            ],
        ];

        foreach ( $rolePermissions as  $rolePermission ) {
            DB::table( "permission_role" )->insert( $rolePermission );
        }
    }
}
