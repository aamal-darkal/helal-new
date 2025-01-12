<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** create menu of province and its record */
        $sarcNewsMenu =   ['title_en' => 'sarc-new', 'title_ar' => 'أخبار المنظمة', 'url' => 'search?province=1', 'order' => 1,  'permit' => 'none', 'menu_id' => 4, 'section_id' => null];
        $sarcNewsprovince =   ['name_en' => 'sarc-new', 'name_ar' => 'المنظمة', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 22];

        Menu::create($sarcNewsMenu)->province()->create($sarcNewsprovince);

        $provinceMenus = [
            ['title_en' => 'Damascus', 'title_ar' => 'دمشق', 'order' => 2, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Aleppo', 'title_ar' => 'حلب', 'order' => 3, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Rural Damascus', 'title_ar' => 'ريف دمشق', 'order' => 4, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Daraa', 'title_ar' => 'درعا', 'order' => 5, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Sweida', 'title_ar' => 'السويداء', 'order' => 6, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Quneitra', 'title_ar' => 'القنيطرة', 'order' => 7, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Latakia', 'title_ar' => 'اللاذقية', 'order' => 8, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Tartus', 'title_ar' => 'طرطوس', 'order' => 9, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Idleb', 'title_ar' => 'إدلب', 'order' => 10, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Hama', 'title_ar' => 'حماة',  'order' => 11, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Hasakeh', 'title_ar' => 'الحسكة',  'order' => 12, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Raqqa', 'title_ar' => 'الرقة',  'order' => 13, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Deir Ezzur', 'title_ar' => 'ديرالزور',  'order' => 14, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
            ['title_en' => 'Homs', 'title_ar' => 'حمص',  'order' => 15, 'permit' => 'none', 'menu_id' => env('MENU_PROVINCE')],
        ];

        $provinces = [
            ['name_en' => 'Damascus', 'name_ar' => 'دمشق', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 25],
            ['name_en' => 'Aleppo', 'name_ar' => 'حلب', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 26],
            ['name_en' => 'Rural Damascus', 'name_ar' => 'ريف دمشق', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 27],
            ['name_en' => 'Daraa', 'name_ar' => 'درعا', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 28],
            ['name_en' => 'Sweida', 'name_ar' => 'السويداء', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 29],
            ['name_en' => 'Quneitra', 'name_ar' => 'القنيطرة', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 30],
            ['name_en' => 'Latakia', 'name_ar' => 'اللاذقية', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 31],
            ['name_en' => 'Tartus', 'name_ar' => 'طرطوس', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 32],
            ['name_en' => 'Idleb', 'name_ar' => 'إدلب', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 33],
            ['name_en' => 'Hama', 'name_ar' => 'حماة', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 34],
            ['name_en' => 'Hasakeh', 'name_ar' => 'الحسكة', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 35],
            ['name_en' => 'Raqqa', 'name_ar' => 'الرقة', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 36],
            ['name_en' => 'Deir Ezzur', 'name_ar' => 'ديرالزور', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 37],
            ['name_en' => 'Homs', 'name_ar' => 'حمص', 'location_ar' => '', 'location_en' => '', 'phone' => '', 'menu_id' => 38],
        ];

        foreach ($provinceMenus as $key => $provinceMenu) {
            $menu = Menu::create($provinceMenu);
            $province = $menu->province()->create($provinces[$key]);
            $menu->url = "search?province=$province->id";
            $menu->save();
        }
        DB::raw("update section set province_id = 1");
    }
}
