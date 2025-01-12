@extends('dashboard.layouts.app')
@section('content')
    <div class="padding">
        <div class="box-header text-primary d-flex justify-component-between">
            <h2> عناصر الصفحة الرئيسية</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-input">
                <thead>
                    <tr>
                        <th>الوصف</th>
                        <th>القيمة</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($components as $k => $setting)
                        <tr>
                            <td>{{ $setting->key_ar }}</td>
                            <form action="{{ route('dashboard.settings.update', $setting) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <td>
                                    @if ($setting->isFile)
                                        <div class="border border-secondary p-2">
                                            <input type="file" name="value_en" accept="image/*" disabled
                                                onchange="showFile(this , 'img-review-{{ $k }}')" required>
                                            <img id="img-review-{{ $k }}" src="{{ getImgUrl($setting->value_en) }}" alt=""
                                                width="100%">
                                        </div>
                                    @else
                                        <div>
                                            <textarea name="value_ar" class="form-control" disabled>{{ $setting->value_ar }}</textarea>
                                            <textarea name="value_en" class="form-control" disabled>{{ $setting->value_en }}</textarea>
                                        </div>
                                    @endif
                                </td>
                                <td style="width:160px">
                                    <button class="btn btn-secondary" data-state="modify"
                                        onclick="return openEdit(this)">تعديل</button>
                                    <button type="button" class="btn btn-outline-secondary invisible"
                                        onclick="return closeEdit(this)">الغاء</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <br>
    @endsection
    @push('js')
        <script>
            function openEdit(btn) {
                btn.classList.toggle('btn-secondary')
                btn.classList.toggle('btn-primary')
                if (btn.getAttribute("data-state") == "modify") {
                    btn.setAttribute("data-state", "save")
                    btn.innerHTML = "حفظ"
                    /** enable input */
                    for (let element of btn.parentNode.previousElementSibling.children[0].children)
                        element.disabled = false

                    /** إظهار زر الغاء */
                    btn.nextElementSibling.classList.remove('invisible')
                    /** تعطيل بقية الأزرار */
                    remainButtons = document.querySelectorAll("[data-state='modify']")
                    for (let remainButton of remainButtons)
                        remainButton.disabled = true
                    return false;
                } else return true;
            }

            function closeEdit(btn) {
                /** إلغاء تعطيل بقية الأزرار */
                remainButtons = document.querySelectorAll("[data-state='modify']")
                for (let remainButton of remainButtons)
                    remainButton.disabled = false

                /** تعديل وظيفة زر التعديل*/
                btn.previousElementSibling.classList.toggle('btn-secondary')
                btn.previousElementSibling.classList.toggle('btn-primary')
                btn.previousElementSibling.setAttribute("data-state", "modify")
                btn.classList.add('invisible')
                for (let element of btn.parentNode.previousElementSibling.children[0].children)
                    element.disabled = true

                btn.previousElementSibling.innerHTML = "تعديل"
            }
        </script>
        @include('dashboard.js-components.showUploadedfile')
    @endpush