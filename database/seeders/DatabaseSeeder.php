<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(SettingSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(DoingSeeder::class);// with keywords
       
        /** province & doing related to menu */
        $this->call(ProvinceSeeder::class);
        $this->call(MartyerSeeder::class);
       
        $this->call(UserSeeder::class);    
    }
}
