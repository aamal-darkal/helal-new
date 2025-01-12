<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    function index()
    {
        $components = Setting::get();

        return view('dashboard.settings.index', compact('components'));
    }

    function update(Setting $setting, Request $request)
    {
        if ($setting->isFile) {
            if (!$request->hasFile('value_en'))
                return back()->with(['error' => "لم يتم رفع ملف     $setting->key_ar "]);
            $oldFile = Image::find($setting->value_ar);
            $image_id = saveImg('main', $request->value_en);
            $setting->value_ar = $image_id;
            $setting->value_en = $image_id;
        } else {
            $setting->value_ar =  $request->value_ar;
            $setting->value_en =  $request->value_en;
        }
        $setting->updated_by = Auth::user()->id;
        $setting->save();
        if ($oldFile) {
            Storage::disk('public')->delete($oldFile->name);
            $oldFile->delete();
        }

        return back()->with(['success' => "تم تعديل $setting->key_ar بنجاح"]);
    }
}
