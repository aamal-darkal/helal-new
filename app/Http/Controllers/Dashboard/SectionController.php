<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Doing;
use App\Models\Image;
use App\Models\Menu;
use App\Models\Province;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    // public $type;
    public function __construct(Request $request)
    {
        session()->flash('type', $request->type);
    }

    public function index(Request $request)
    {
        $type = $request->type;
        $search = $request->search;
        $sections = Section::select('id','hidden', 'image_id', 'created_at', 'created_by', 'updated_at', 'updated_by')
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($q) use ($search) {
                    return $q->where('title_ar', 'like', "%$search%")
                        ->orWhere('title_en', 'like', "%$search%");
                });
            })->when(Auth::user()->type == 'user', function ($q) {
                return $q->whereHas('provinces', function($q){
                    return $q->where('id' , Auth::user()->province_id);
                });            
            })->where('type', $type)
            ->with(['sectionDetail_ar:section_id,title', 'sectionDetail_en:section_id,title','createdBy:id,name', 'updatedBy:id,name'])
            ->latest()
            ->paginate();
            // return $sections;
        return view('dashboard.sections.index',   compact('sections', 'type', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->type;
        $menu = $request->menu;
        if ($menu) $menu = Menu::find($menu);

        $provinces = Province::select('id', 'name_ar as name')
            ->when(Auth::user()->type == 'user', function ($q) {
                return $q->where('id', Auth::user()->province_id);
            })->get();
        $doings = Doing::select('id', DB::raw("concat(title_ar , ' - ' , title_en) as name"))->get();

        return view(
            'dashboard.sections.create',
            compact('type', 'provinces', 'doings', 'menu')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        /** save image if exists */
        $image_id = null;
        if ($request->hasFile('image_id')) {
            $image_id = saveImg($request->type, $request->file('image_id'));
        }

        /** saving section */
        $section = Section::create([
            'type' => $request->type,
            'summary-length' => $request->input('summary-length'),
            'date' => $request->date,
            'hidden' => $request->hidden,
            'image_id' => $image_id,
            'province_id' => $request->province_id,
            'created_by' => Auth::user()->id,
        ]);

        /** saving section_details */
        if ($request->arabic)
            $section->sectionDetails()->create(['title' => $request->title_ar,  'content' => $request->content_ar, 'lang' => 'ar']);
        if ($request->english)
            $section->sectionDetails()->create(['title' => $request->title_en,  'content' => $request->content_en, 'lang' => 'en']);

        /** saving relation to doings if exists*/
        if ($request->doings)
            $section->doings()->attach($request['doings']);
        
        if ($request->provinces)
            $section->provinces()->attach($request['provinces']);

        /** saving related menu if exists */
        $menu_id = $request->menu_id;
        if ($menu_id) {
            $menu = Menu::find($menu_id);
            $menu->update(['url' => "show/$section->id", 'section_id' => $section->id]);
            return to_route('dashboard.menus.show', [$menu->menu_id])->with('success', "تم إضافة بند للقائمة  " . $menu->parentMenu->title_ar . " بنجاح");
        }
        return to_route('dashboard.sections.index', ['type' => $request->type])->with('success', "تم إضافة بيانات ال" . __("helal.section-types.$request->type.singular")  .  " بنجاح");
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return redirect()->route("home.show", ['section' => $section]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section, Request $request)
    {
        $menu = $request->menu;
        if ($menu)
            $menu = Menu::find($menu);

        $type = $section->type;

        $provinces = Province::select('id', 'name_ar as name')
            ->when(Auth::user()->type == 'user', function ($q) {
                return $q->where('id', Auth::user()->province_id);
            })->get();

        $doings = Doing::select('id', DB::raw("concat(title_ar , ' - ' , title_en) as name"))->get();
        $currDoings =$section->doings->modelKeys();
        $currProvinces = $section->provinces? $section->provinces->modelKeys():[];

        $section->arabic  = (bool) $section->sectionDetail_ar;
        $section->english = (bool) $section->sectionDetail_en;

        return view('dashboard.sections.edit', compact('type', 'provinces', 'doings', 'currDoings', 'currProvinces', 'section', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Section $section)
    {
        $validated = $request->validated();
        $validated['updated_by'] = Auth::user()->id;

        $type = $section['type'];

        $oldImage = null;
        if ($request->hasFile('image_id')) {
            $oldImage = Image::find($section->image_id);
            $validated['image_id'] = saveImg($type, $request->file('image_id'));
        }

        $section->update($validated);

        /** saving section_details */
        if ($request->arabic){
            if($section->sectionDetail_ar)
                $section->sectionDetail_ar()->update(['title' => $request->title_ar,  'content' => $request->content_ar]);
            else
                $section->sectionDetails()->create(['title' => $request->title_ar,  'content' => $request->content_ar , 'lang' => 'ar' ]);
        } else {
            if($section->sectionDetail_ar)
                $section->sectionDetail_ar()->delete();
        }
        if ($request->english){
            if($section->sectionDetail_en)
                $section->sectionDetail_en()->update(['title' => $request->title_en,  'content' => $request->content_en]);
            else
                $section->sectionDetails()->create(['title' => $request->title_en,  'content' => $request->content_en , 'lang' => 'en']);
        } else {
            if($section->sectionDetail_en)
                $section->sectionDetail_en->delete();
        }        

        /** delete image record from images table with related file */
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage->name);
            $oldImage->delete();
        }

        if ($request->doings) {
            $section->doings()->sync($validated['doings']);
        }
        if ($request->provinces) {
            $section->provinces()->sync($validated['provinces']);
        }

        $menu_id = $request->menu_id;
        if ($menu_id) {
            $menu = Menu::find($menu_id);
            if ($menu->menu_id)
                return to_route('dashboard.menus.show', $menu->menu_id)->with('success', "تم تعديل بند القائمة  $menu->title_ar بنجاح");
            else
                return to_route('dashboard.menus.index')->with('success', "تم تعديل بند القائمة  $menu->title_ar بنجاح");
        }
        return to_route('dashboard.sections.index', ['type' => $type])->with('success', "تم حفظ بيانات ال" .  __("helal.section-types.$type.singular") . " بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $oldImage = Image::find($section->image_id);
        $title = $section->sectionDetail_ar?$section->sectionDetail_ar->title:
        ($section->sectionDetail_en? $section-> sectionDetail_en->title:'');
        $type = $section->type;
        $section->sectionDetails()->delete();
        $section->delete();

        if ($oldImage) {
            Storage::disk('public')->delete($oldImage->name);
            $oldImage->delete();
        }

        return back()->with('success', "تم محي $type ذات العنوان: $title بنجاح ");
    }
}
