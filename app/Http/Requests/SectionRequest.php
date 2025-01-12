<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [ 
            'type' => ["required" , Rule::in(config('app.section-type'))  ] ,
            // 'type' => ["required"   ] ,
            'arabic' => 'nullable',
            'english' => 'nullable',
            'title_ar' => 'required_if:arabic,1|max:100',
            'title_en' => 'required_if:english,1|max:100',
            'content_ar' => 'required_if:arabic,1',
            'content_en' => 'required_if:english,1',
            'summary-length' => 'nullable|int',
            'date' =>'nullable|date',
            'hidden' => "nullable|in:1,0",
            'image_id' => 'nullable|file|max:5000',

            'doings' => 'nullable|array',
            'doings.*' => 'required|exists:doings,id',
            
            'provinces' => 'required|array',
            'provinces.*' => 'required|exists:provinces,id',
            
        ];
    }
    function messages()
    {
        return [
            'type.in' =>  'يوجد خطأ في تحديد نوع المقطع المضاف'
        ];
    }
}
