<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Section;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller

{
    public function index(Request $request)
    {
        $menus = Menu::whereNull('menu_id')
            ->withCount('subMenus')
            ->orderBy('order')->get();
        $menu = null;
        // return $menus;
        return view('dashboard.menus.index', compact('menus', 'menu'));
    }

    /**
     * show sub menu
     */
    public function show(Menu $menu)
    {
        $menus = Menu::where('menu_id', $menu->id)
            ->withCount('subMenus')
            ->orderBy('order')->get();

        return view('dashboard.menus.index', compact('menus', 'menu'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        /** get menu_id */
        $menu = Menu::find($request->menu);
        if ($menu->id == env('MENU_DOING'))
            return back()->with('error', 'إذارة هذه القائمة تتم من خلال بند [ صناديق ماذا نفعل]');

        if ($menu->id == env('MENU_PROVINCE'))
            return back()->with('error', 'إذارة هذه القائمة تتم من خلال بند محافظات');

        return view('dashboard.menus.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'title_ar' => 'required|string|max:100|unique:menus',
            'title_en' => 'nullable|string|max:100|unique:menus',
            'menu_id' => 'exists:menus,id',
        ]);

        $validated['order'] = Menu::where('menu_id', $validated['menu_id'])->max('order') + 1;
        $validated['created_by'] = Auth::user()->id;

        $menu = Menu::create($validated);

        return to_route('dashboard.sections.create', ['type' => 'page', 'menu' => $menu->id]);
    }

    public function edit(Menu $menu)
    {
        return view('dashboard.menus.edit',  compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated =  $request->validate([
            'title_ar' => "required|string|max:100|unique:menus,title_ar,$menu->id",
            'title_en' => "nullable|string|max:100|unique:menus,title_en,$menu->id",
            'menu_id' => 'exists:menus,id',
        ]);

        $menu->update($validated);
        $validated['updated_by'] = Auth::user()->id;

        return to_route('dashboard.sections.edit', ['section' => $menu->section_id, 'type' => 'page', 'menu' => $menu->id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {

        $section = $menu->section_id;
        $title = $menu->title_ar;
        $menu->delete();
        Section::find($section)->delete();

        return back()->with('success', " تم محي سجل القائمة: $title بنجاح");
    }
}
