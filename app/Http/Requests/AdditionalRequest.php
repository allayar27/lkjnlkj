<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdditionalRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check();
    }


    public function rules()
    {
        return [
            'title' => 'required',
            'media' => 'required|mimes:pptx,ppt,doc,docx,pdf,xlsx|max:50000',
            'lesson_id' => 'required|numeric|exists:App\Models\Lesson,id'
        ];
    }
}
