@extends('dashboard.layouts.app')
@section('title', 'الشواغر')
@section('content')
    <div class="d-flex justify-content-between">
        <h4 class="title"> الشواغر </h4>
        <a href="{{ route('dashboard.xxxxxes.create', ) }}" 
        class="btn btn-secondary mb-2">إضافة شاغر</a>
    </div>
    <form action="{{ route('dashboard.xxxxxes.index') }}" class="d-flex mb-2">
        <button class="btn btn-secondary">بحث</button>
        <input type="text" class="form-control" name="search" value="{{ $search }}">
        @if ($search)
            <a href="{{ route('dashboard.xxxxxes.index') }}"
                class="btn btn-outline-secondary text-nowrap">كافة الشواغر</a>
        @endif
    </form>
    <table class="table table-bordered table-striped">
        <thead class="table-secondary">

            <tr>
                <th> # </th>
                <th> العنوان  </th>
                <th> مخفي</th>
                <th> الصورة </th>
                <th> المدخل </th>
                <th> تاريخ الإدخال </th>
                <th> المعدل </th>
                <th> تاريخ التعديل </th>
                <th> أوامر </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($xxxxxes as $xxxxx)
                <tr>
                    <td> {{ $xxxxx->id }}</td>
                    <td> {{ $xxxxx->title }}</td>                    
                    <td> <input type="checkbox" @checked($xxxxx->hidden) disabled></td>
                    <td><img src="{{ getImgUrl($xxxxx->image_id) }}" width="75"></td>

                    <td> {{ $xxxxx->createdBy->name }}</td>
                    <td> {{ $xxxxx->created_at }}</td>
                    <td> {{ $xxxxx->updatedBy->name }}</td>
                    <td> {{ $xxxxx->updated_at }}</td>

                    <td class="text-nowrap">
                        <a href="{{ route('dashboard.xxxxxes.edit', $xxxxx) }}" class="btn btn-outline-primary">
                            <i data-feather="edit"></i>
                        </a>
                        <form action="{{ route('dashboard.xxxxxes.destroy', $xxxxx) }}" method="post"
                            class="d-inline-block"
                            onsubmit="return confirm('سيتم محي   {{ $xxxxx->title }}?' )">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger"><i data-feather="trash"></i></button>
                        </form>
                        <a href="{{ route('dashboard.xxxxxes.show', $xxxxx) }}" class="btn btn-outline-success">
                            <i data-feather="eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $xxxxxes->links() }}

@endsection
