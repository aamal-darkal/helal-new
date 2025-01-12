<?php

namespace Database\Seeders;

use App\Models\Martyer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MartyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $martyars = [
            ['name_ar' => 'بشار اليوسف' , 'name_en' => 'Bashar Al Yusef', 'DOD' => '2013', 'province_id' => 1 ],
            ['name_ar' => 'ابراهيم عيد' , 'name_en' => 'Ebrahim Eed', 'DOD' => '1999', 'province_id' => 2],
            ['name_ar' => 'فاضل عجاج' , 'name_en' => 'Fadel Ajaj', 'DOD' => '2006', 'province_id' => 1],
        ];
        Martyer::insert($martyars);
    }
}
