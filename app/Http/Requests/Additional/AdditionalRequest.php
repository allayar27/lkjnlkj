<?php

namespace App\Http\Requests\Additional;

use App\Models\Additional;
use Illuminate\Foundation\Http\FormRequest;

class AdditionalRequest extends FormRequest
{

    public function authorize():bool
    {
        return $this->user()->can('create-additionals', Additional::class);
    }


    public function rules():array
    {
        return [
            'title' => 'required',
            'media' => 'required|mimes:pptx,ppt,doc,docx,pdf,xlsx|max:50000',
            'lesson_id' => 'required|numeric|exists:App\Models\Lesson,id'
        ];
    }
}
