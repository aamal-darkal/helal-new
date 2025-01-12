@extends('dashboard.layouts.app')
@section('title', 'الحسابات')

@section('content')
    <div class="d-flex justify-content-between">
        <h4 class="title"> الحسابات </h4>
        <a href="{{ route('dashboard.users.create') }}" class="btn btn-secondary mb-2">إضافة حساب</a>
    </div>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-secondary">
            <tr>
                <th> # </th>
                <th> الاسم </th>
                <th> البريد الالكتروني </th>
                <th> المحافظة </th>
                <th> نوع الحساب </th>
                <th> حالة الحساب </th>
                <th> أوامر </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
                <tr>
                    <td> {{ $user->id }}</td>
                    <td> {{ $user->name }}</td>
                    <td> {{ $user->email }}</td>
                    <td> {{ $user->province->name_ar }}</td>
                    <td> {{ $user->type }}</td>
                    <td> {{ $user->state }}</td>

                    <td class="text-nowrap">

                        <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="تعديل الحساب">
                            <i data-feather="edit"></i>
                        </a>
                        <form method="post" action="{{ route('dashboard.users.reset-password' , $user) }}" class="d-inline-block" 
                            onsubmit="return confirm(' تصفير كلمة المرور لحساب {{ $user->name }}?' )">
                            @csrf
                            <button href="" class="btn btn-sm btn-outline-warning" title="تصفير كلمة المرور">
                                <i data-feather="rotate-ccw"></i>                            
                            </button>                      
                        </form>
                        <form method="post" action="{{ route('dashboard.users.lock' , $user) }}" class="d-inline-block" 
                            onsubmit="return confirm(' قفل حساب {{ $user->name }}?' )">
                            @csrf
                            <button href="" class="btn btn-sm btn-outline-danger" title="قفل حساب">
                                <i data-feather="lock"></i>                            
                            </button>                      
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
