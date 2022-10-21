<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "admin",
                "email" => "admin@gmail.com",
                "birthday" => "1998-07-19",
                "phonenumber" => "0708050907",
                "email_verified_at" => now()->toDateTimeString(),
                "address" => "Phường Hương Chữ, Thị xã Hương Trà, Tỉnh Thừa Thiên Huế",
                "password" => hash( "sha256", "1111111" ),
                "role_id" => 1,
                "admin" => true,
                "is_active" => true,
                "gender" => 1,
                "avata" => "images/avata/man.png",
            ],
            [
                "name" => "editor",
                "email" => "editor@gmail.com",
                "birthday" => "1998-07-19",
                "phonenumber" => "0708050907",
                "email_verified_at" => now()->toDateTimeString(),
                "address" => "Phường Hương Chữ, Thị xã Hương Trà, Tỉnh Thừa Thiên Huế",
                "password" => hash( "sha256", "1111111" ),
                "role_id" => 2,
                "admin" => true,
                "is_active" => true,
                "gender" => 1,
                "manager" => 1,
                "avata" => "images/avata/man.png",
            ],
            [
                "name" => "user",
                "email" => "user@gmail.com",
                "birthday" => "1998-07-19",
                "phonenumber" => "0708050907",
                "email_verified_at" => now()->toDateTimeString(),
                "address" => "Phường Hương Chữ, Thị xã Hương Trà, Tỉnh Thừa Thiên Huế",
                "password" => hash( "sha256", "1111111" ),
                "role_id" => 3,
                "admin" => false,
                "is_active" => true,
                "gender" => 1,
                "manager" => 2,
                "avata" => "images/avata/man.png",
            ],
        ];

        foreach ( $users as $user ) {
            User::create( $user  );
        }
    }
}
