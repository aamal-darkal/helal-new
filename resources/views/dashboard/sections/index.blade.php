@extends('dashboard.layouts.app')
@section('title', __("helal.section-types.$type.plural"))
@section('content')
    <div class="d-flex justify-content-between">
        <h4 class="title"> {{ __("helal.section-types.$type.plural") }} </h4>
        <a href="{{ route('dashboard.sections.create', ['type' => $type]) }}" class="btn btn-secondary mb-2">إضافة
            {{ __("helal.section-types.$type.singular") }}</a>
    </div>
    <form action="{{ route('dashboard.sections.index') }}" class="d-flex mb-2">
        <button class="btn btn-secondary">بحث</button>
        <input type="text" class="form-control" name="search" value="{{ $search }}">
        <input type="hidden" name="type" value="{{ $type }}">
        @if ($search)
            <a href="{{ route('dashboard.sections.index', ['type' => $type]) }}"
                class="btn btn-outline-secondary text-nowrap">كافة {{ __("helal.section-types.$type.plural") }}</a>
        @endif
    </form>
    <table class="table table-bordered table-striped text-center">
        <thead class="table-secondary">

            <tr>
                <th> # </th>
                <th> العنوان بالعربي </th>
                <th> العنوان بالانكليزي</th>
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
            @foreach ($sections as $section)
                <tr>
                    <td> {{ $section->id }}</td>
                    <td> {{ $section->sectionDetail_ar ? $section->sectionDetail_ar->title : '' }}</td>
                    <td> {{ $section->sectionDetail_en ? $section->sectionDetail_en->title : '' }}</td>
                    <td> <input type="checkbox" @checked($section->hidden) disabled></td>
                    <td><img src="{{ getImgUrl($section->image_id) }}" width="75"></td>
                    <td> {{ $section->created_by ? $section->createdBy->name : '' }} </td>
                    <td> {{ $section->created_at ? $section->created_at->format('Y-m-d'): '' }}</td>
                    <td> {{ $section->updatedBy  ? $section->updatedBy->name : '' }} </td>
                    <td> {{ $section->updated_at ? $section->updated_at->format('Y-m-d'):'' }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('dashboard.sections.edit', $section) }}" class="btn btn-outline-primary">
                            <i data-feather="edit"></i>
                        </a>
                        <form action="{{ route('dashboard.sections.destroy', $section) }}" method="post"
                            class="d-inline-block" onsubmit="return confirm('سيتم محي   {{ $section->sectionDetail_ar?$section->sectionDetail_ar->title: ($section->sectionDetail_en?$section->sectionDetail_en->title:'')}}?' )">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger"><i data-feather="trash"></i></button>
                        </form>
                        <a href="{{ route('dashboard.sections.show', $section) }}" class="btn btn-outline-success">
                            <i data-feather="eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sections->links() }}

@endsection
