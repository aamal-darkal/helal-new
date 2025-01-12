<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    // $table->rememberToken();
    public function run(): void
    {
        $users = [
            ['name' => 'Test', 'email' => 't@t.com', 'password' => Hash::make('123'), 'province_id' => 1, 'type' => 'admin' , 'state' => 'normal' ],
            ['name' => 'Leen', 'email' => 'leen@sarc.com', 'password' => Hash::make('123'), 'province_id' => 1, 'type' => 'admin' , 'state' => 'normal']
        ];

        User::insert($users);
    }
}
