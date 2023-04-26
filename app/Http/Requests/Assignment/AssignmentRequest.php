<?php

namespace App\Http\Requests\Assignment;

use App\Models\Assignment;
use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
{

    public function authorize():bool
    {
        return $this->user()->can('create-assignments', Assignment::class);
    }


    public function rules():array
    {
        return [
            'title' => 'required|string',
            'due_date' => 'required|date',
            'file' => 'required|mimes:pptx,ppt,doc,docx,pdf,xlsx|max:9000',
            'lesson_id' => 'required|numeric|exists:lessons,id'
        ];
    }
}
