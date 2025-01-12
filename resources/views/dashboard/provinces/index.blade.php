@extends('dashboard.layouts.app')
@section('title', 'المحافظات')

@section('content')
    <div class="d-flex justify-content-between">
        <h4 class="title"> المحافظات </h4>
        {{-- <a href="{{ route('dashboard.provinces.create') }}" class="btn btn-secondary mb-2">إضافة محافظة</a> --}}
    </div>
    
    <table class="table table-bordered table-striped text-center">
        <thead class="table-secondary">
            <tr>
                <th> # </th>
                <th>  الاسم بالعربي </th>
                <th>  الاسم بالانكليزي </th>
                <th> العنوان بالعربي   </th>
                <th> العنوان بالانكليزي </th>
                <th> رقم الهاتف </th>
                <th> المعدل </th>
                <th> تاريخ التعديل </th>
                <th> أوامر </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($provinces as $province)
                <tr>
                    <td> {{ $province->id }}</td>
                    <td> {{ $province->name_ar }}</td>
                    <td> {{ $province->name_en }}</td>
                    <td> {{ $province->location_ar }}</td>
                    <td> {{ $province->location_en }}</td>
                    <td> {{ $province->phone }}</td>
                    <td> {{ $province->updated_by  ? $province->updated_by->name : '' }} </td>
                    <td> {{ $province->updated_at ? $province->updated_at->format('Y-m-d'):'' }}</td>

                    <td class="text-nowrap">
                        <a href="{{ route('dashboard.provinces.edit', $province) }}" class="btn btn-outline-primary">
                            <i data-feather="edit"></i>
                        </a>
                        {{-- <form action="{{ route('dashboard.provinces.destroy', $province) }}" method="post" class="d-inline-block"
                            onsubmit="return confirm('سيتم محي   {{ $province->name }}?' )">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger"><i data-feather="trash"></i></button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
