<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $sectionsCount = Section::count();
        $newsCount = Section::where('type' , 'news' )->count();
        $storiesCount = Section::where('type' , 'story' )->count();
        $campaignCount = Section::where('type' , 'campaign' )->count();
        return view('dashboard.home' , compact('sectionsCount' , 'newsCount' , 'storiesCount' , 'campaignCount'));
    }
}
