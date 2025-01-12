<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinceController extends Controller

{
    public function index(Request $request)
    {
        $provinces = Province::orderBy('name_ar')
            ->with(['updatedBy:id,name'])
            ->get();
        return view('dashboard.provinces.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('dashboard.provinces.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $validated =  $request->validate([
    //         'name_ar' => 'required|string|max:30|unique:provinces',
    //         'name_en' => 'nullable|string|max:30|unique:provinces',
    //         'location_ar' => 'nullable|string|max:255',
    //         'location_en' => 'nullable|string|max:255',
    //         'phone' => 'nullable|digits:10'
    //     ]);
    //     $validated['created_by'] = Auth::user()->id;

    //     $province = Province::create($validated);

    //     $menu = Menu::create([
    //         'title_ar' =>  $validated['name_ar'],
    //         'title_en' => $validated['name_en'],
    //         'url' => "search?province=$province->id",
    //         'order' => menu::where('menu_id', env('MENU_PROVINCE'))->max('order') + 1,
    //         'permit' => 'none',            
    //         'menu_id' => env('MENU_PROVINCE'),
    //         'created_by' => $validated['created_by'],
    //     ]);
    //     $province->menu_id = $menu->id;
    //     $province->save();
    //     return to_route('dashboard.provinces.index')->with('success', "تم إضافة المحافظة بنجاح");
    // }

    public function edit(Province $province)
    {
        return view('dashboard.provinces.edit',  compact('province'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        $validated =  $request->validate([
            // 'name_ar' => "required|string|max:30|unique:provinces,name_ar,$province->id",
            // 'name_en' => "required|string|max:30|unique:provinces,name_en,$province->id",
            'location_ar' => 'nullable|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'phone' => 'nullable|digits:10'
        ]);
        $validated['updated_by'] = Auth::user()->id;

        $province->update($validated);

        // $province->menu()->update([
        //     'title_ar' =>  $validated['name_ar'],
        //     'title_en' => $validated['name_en'],
        //     'updated_by' => $validated['updated_by'],
        // ]);

        return to_route('dashboard.provinces.index')->with('success', "تم تعديل المحافظة بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Province $province)
    // {
    //     $userCount = $province->users->count();
    //     if ($userCount)
    //         return back()->with('error', " لا يمكن محي المحافظة لوجود مستخدم  $userCount مرتبط به");

    //     $sectionsCount = $province->sections->count();
    //     if ($sectionsCount)
    //         return back()->with('error', " لا يمكن محي المحافظة لوجود $sectionsCount عنصر مرتبطة به");
    //     $name = $province->name_ar;
    //     $menu_id = $province->menu_id;
    //     $province->delete();
    //     Menu::find($menu_id)->delete();

    //     return back()->with('success', " تم محي المحافظة $name بنجاح");
    // }
}
