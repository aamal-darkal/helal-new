<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(){
        return view('dashboard.profile.edit');
    }
    public function update(Request $request){
        $validated = $request->validate( [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        return to_route('dashboard')->with('success', "تم تعديل كلمة السر بنجاح");
        
    }
}
