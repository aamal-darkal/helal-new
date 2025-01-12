@extends('dashboard.layouts.app')
@section('title', 'ماذا نفعل')

@section('content')
    <div class="d-flex justify-content-between">
        <h4 class="title"> قائمة ماذا نفعل </h4>
        <a href="{{ route('dashboard.doings.create') }}" class="btn btn-secondary mb-2">إضافة بند ماذا نفعل</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-secondary">
            <tr>
                <th> # </th>
                <th> العنوان بالعربي </th>
                <th> العنوان بالانكليزي </th>
                <th> المدخل </th>
                <th> تاريخ الإدخال </th>
                <th> المعدل </th>
                <th> تاريخ التعديل </th>
                <th> الصورة </th>
                <th> أوامر </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doings as $doing)
                <tr>
                    <td> {{ $doing->id }}</td>
                    <td> {{ $doing->title_ar }}</td>
                    <td> {{ $doing->title_en }}</td>
                    <td> {{ $doing->created_by ? $doing->createdBy->name : '' }} </td>
                    <td> {{ $doing->created_at ? $doing->created_at->format('Y-m-d'): '' }}</td>
                    <td> {{ $doing->updatedBy  ? $doing->updatedBy->name : '' }} </td>
                    <td> {{ $doing->updated_at ? $doing->updated_at->format('Y-m-d'):'' }}</td>
                    <td> {!! $doing->icon !!}</td>

                    <td class="text-nowrap">
                        <button @disabled($doing->hidden)
                            onclick="location = '{{ route('dashboard.doings.edit', $doing) }}'"
                            class="btn btn-outline-primary">
                            <i data-feather="edit"></i>
                        </button>
                        <form action="{{ route('dashboard.doings.destroy', $doing) }}" method="post" class="d-inline-block"
                            onsubmit="return confirm('سيتم محي   {{ $doing->name }}?' )">
                            @csrf
                            @method('delete')
                            <button @disabled($doing->hidden) class="btn btn-outline-danger"><i
                                    data-feather="trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
