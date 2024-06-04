<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
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
        $userData = [
            [
                'name'      => 'Admin Aplikasi',
                'role'     => 'admin',
                'email'     => 'Admin@gmail.com',
                'password'  =>  bcrypt('iniadmin'),
            ],
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }

    }
}
