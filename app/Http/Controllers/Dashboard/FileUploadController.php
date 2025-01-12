<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\FileType;
use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FileUploadController extends Controller
{
    public function index(Request $request)
    {
        $fileUploads = FileUpload::with('createdBy:id,name')
            ->select('id', DB::raw("concat('storage/files/', type , '/', name ) as url"), "name", "type", "description" , "created_at")
            ->latest()->get();
        // return $fileUploads;
        return view('dashboard.fileUploads.index', compact('fileUploads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fileTypes = FileType::getFileTypes();

        return view('dashboard.fileUploads.create', compact('fileTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'name' => 'required|string|max:50',
            'type' => ['required', 'string', Rule::in(FileType::cases())],
            'description' => 'required|string|max:200',
            'file' => 'required|file|max:2000',
        ]);

        /** save file */
        $file = $request->file('file');
        $validated['name'] .= "-" . time() . "." . $file->extension();
        $file->storeAs("files/$validated[type]",   $validated['name'], 'public');

        $validated['created_by'] = Auth::user()->id;
        FileUpload::create($validated);
        $url = asset("storage/files/$validated[type]/$validated[name]");
        return to_route('dashboard.fileUploads.index')->with('success', "تم تحميل الملف بنجاح على الرابط $url");
    }


    // public function edit(FileUpload $fileUpload)
    // {
    //     $fileTypes = FileType::getFileTypes();
    //     return view('dashboard.fileUploads.edit',  compact('fileUpload', 'fileTypes'));
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, FileUpload $fileUpload)
    // {
    //     $validated =  $request->validate([
    //         'name' => 'required|string|max:50',
    //         'type' => ['required', 'string', Rule::in(FileType::cases())],
    //         'description' => 'required|string|max:200',
    //         'file' => 'required|file|max:2000',
    //     ]);
    //     $validated['updated_by'] = Auth::user()->id;
    //     if ($request->hasFile('file')) {

    //         /** delete previous file */
    //         $name = $fileUpload->name;
    //         $type = $fileUpload->type;
    //         $extension = $fileUpload->extension;
    //         Storage::disk('public')->delete("storage/files/$type/$name.$extension");

    //         /** save new file */
    //         $file = $request->file('file');
    //         $validated['name'] 

    //         .= "-" . time() . "." . $file->extension();
    //         $file->storeAs("files/$validated[type]", $validated['name'], 'public');
    //     }
    //     $fileUpload->update($validated);

    //     $url = asset("storage/files/$validated[type]/$validated[name]");
    //     return to_route('dashboard.fileUploads.index')->with('success', "تم تحميل الملف بنجاح على الرابط $url");
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FileUpload $fileUpload)
    {
        $name = $fileUpload->name;
        $type = $fileUpload->type;
        // return "storage/files/$type/$name";
        Storage::disk('public')->delete("files/$type/$name");
        $fileUpload->delete();

        return back()->with('success', " تم محي سجل أعمالنا: $name بنجاح");
    }
}
