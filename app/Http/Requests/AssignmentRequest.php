<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check();
    }


    public function rules()
    {
        return [
            'title' => 'required',
            'due_date' => 'required|date|after:',
            'file' => 'required|mimes:pptx,ppt,doc,docx,pdf,xlsx|max:90000',
            'lesson_id' => 'required|numeric|exists:lessons,id'
        ];
    }
}
