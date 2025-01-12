<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller

{
    public function index(Request $request)
    {
        $state = '';
        if ($request->has('state') && $request->state == 'change-password')
            $state = 'change-password';
        $users = User::with('province')->orderBy('name')->get();
        return view('dashboard.users.index', compact('users', 'state'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::select('id', 'name_ar as name')->get();
        return view('dashboard.users.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:50|unique:users',
            'type' => 'required|in:admin,user',
            'status' => 'new',
            'province_id' => 'required|exists:provinces,id',
        ]);
        User::create($validated);
        return to_route('dashboard.users.index')->with('success', "تم إضافة الحساب بنجاح");
    }


    public function edit(user $user)
    {
        $provinces = Province::select('id', 'name_ar as name')->get();

        return view('dashboard.users.edit',  compact('user', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        $validated =  $request->validate([
            'name' => 'required|string|max:50',
            'email' => "required|string|max:50|unique:users,email,$user->id",
            'type' => 'required|in:admin,user',
            'province_id' => 'required|exists:provinces,id',
        ]);
        $user->update($validated);


        return to_route('dashboard.users.index')->with('success', "تم تعديل الحساب بنجاح");
    }
    /** reset password */
    function resetPassword(User $user)
    {
            $user->state = 'reset';
            $user->save();
        
        return back()->with('success', "تم تصفير كلمة المرور لحساب $user->name بنجاح");
    }
    /** lock account */
    function lock(User $user)
    {
            $user->state = 'banned';
            $user->save();
        
        return back()->with('success', "تم قفل حساب $user->name بنجاح");
    }
}
