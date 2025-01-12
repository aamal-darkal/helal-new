<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\XxxxxRequest;
use App\Models\Image;
use App\Models\Province;
use App\Models\Xxxxx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class XxxxxController extends Controller
{
    /** 
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $search = $request->search;
        $xxxxxes = Xxxxx::when($search, function ($q) use ($search) {
            return $q->where(function ($q) use ($search) {
                return $q->where('title', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            });
        })->when(Auth::user()->type == 'user', function ($q) {
                return $q->where('province_id', Auth::user()->province_id);            
        })
            ->with(['createdBy:id,name', 'updatedBy:id,name'])
            ->paginate();
        return view('dashboard.xxxxxes.index',   compact('xxxxxes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::select('id', 'name_ar as name')
        ->when(Auth::user()->type == 'user', function ($q) {
            return $q->where('id', Auth::user()->province_id);
        })->get();

        return view(
            'dashboard.xxxxxes.create',
            compact('provinces')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(XxxxxRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = Auth::user()->id;

        if ($request->hasFile('image_id')) {
            $validated['image_id'] = saveImg('xxxxx', $request->file('image_id'));
        }

        Xxxxx::create($validated);

        return to_route('dashboard.xxxxxes.index')->with('success', "تم إضافة بيانات الشاغر بنجاح");
    }

    /**
     * Display the specified resource.
     */
    public function show(Xxxxx $xxxxx)
    {
        return redirect()->route("home.showXxxxx", ['xxxxx' => $xxxxx]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Xxxxx $xxxxx)
    {
        $provinces = Province::select('id', 'name_ar as name')
        ->when(Auth::user()->type == 'user', function ($q) {
            return $q->where('id', Auth::user()->province_id);
        })->get();
        return view('dashboard.xxxxxes.edit', compact('provinces',  'xxxxx',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(XxxxxRequest $request, Xxxxx $xxxxx)
    {
        $validated = $request->validated();
        $validated['updated_by'] = Auth::user()->id;

        $oldImage = null;
        if ($request->hasFile('image_id')) {
            $oldImage = Image::find($xxxxx->image_id);
            $validated['image_id'] = saveImg('xxxxx', $request->file('image_id'));
        }

        $xxxxx->update($validated);

        /** delete image record from images table with related file */
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage->name);
            $oldImage->delete();
        }

        return to_route('dashboard.xxxxxes.index')->with('success', "تم حفظ بيانات الشاغر بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Xxxxx $xxxxx)
    {
        $oldImage = Image::find($xxxxx->image_id);
        $title = $xxxxx->title;
        $xxxxx->delete();

        if ($oldImage) {
            Storage::disk('public')->delete($oldImage->name);
            $oldImage->delete();
        }

        return back()->with('success', "تم محي الشاغر ذات العنوان: $title بنجاح ");
    }
}
