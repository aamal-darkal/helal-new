<?php

namespace App\Providers;

use App\Models\Doing;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {

        Paginator::useBootstrapFive();

        view()->composer(
            ['layouts.app', 'home.index'],
            function ($view) {
                $view->with('doings', $this->getDoings());
            }
        );
        view()->composer(
            ['layouts.app', 'home.index'],
            function ($view) {
                $view->with(
                    'components',
                    $this->getComponents()
                );
            }
        );
        view()->composer(
            ['layouts.app', 'home.index'],
            function ($view) {
                $view->with(
                    'menus',
                    $this->getMenus()
                );
            }
        );
    }

    private function getDoings()
    {
        $locale =   app()->getLocale();

        return Doing::select('id', "title_$locale as title", "icon")->where('hidden', false)->get();
    }

    private function getComponents()
    {
        $locale =   app()->getLocale();

        $settings = Setting::all();
        foreach ($settings as $setting)
            $components[$setting->key_en] = $setting['value_' . $locale];
        return $components;
    }
    
    private function getMenus(){
        $locale =   app()->getLocale();

        return Menu::select("id", "title_$locale as title" , "url")->whereNull('menu_id')
        ->withCount('subMenus')
        ->with(['subMenus' => function ($q) use ($locale) {
            return $q->select("id", "title_$locale as title", "url", "menu_id")
            ->withCount('subMenus')->orderBy('order')
                ->with(['subMenus' => function ($q) use ($locale) {
                    return $q->select("title_$locale as title", 'url', "menu_id")->orderBy('order');
                }]);
        }])->orderBy('order')->get();
    }

}
