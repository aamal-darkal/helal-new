<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LangController extends Controller
{
    function __invoke()
    {        
        $lang = app()->getLocale() == 'ar'? 'en': 'ar';
        app()->setlocale($lang);
        $cookie = Cookie::make('lang' , $lang , 60 * 24 * 365);
        return back()->withCookie($cookie);
    }
}
