@extends('dashboard.layouts.app')
@section('title', 'إضافة ملف')
@section('content')
    <h4 class="title"> إضافة ملف</h4>

    <form action="{{ route('dashboard.fileUploads.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-input name="name" label="اسم الملف" required maxlength="50" />
        <x-select name="type" label="النوع" :options=$fileTypes />
        <x-input name="description" label="وصف الملف" required maxlength="200" />

        <div class="mb-3">
            <x-input name="file" label="الملف" type="file" onchange="showFile(this , 'file-review')" />
            <embed class="border border-secondary" id="file-review" src="{{ asset('storage/no-image.png') }}"
                width="300">
        </div>

        <button class="btn btn-secondary">إضافة الملف</button>
        <a href="{{ route('dashboard.fileUploads.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection

@push('js')
    @include('dashboard.js-components.showUploadedfile')    
@endpush
