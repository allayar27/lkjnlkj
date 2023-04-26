<?php

namespace App\Http\Requests\Response;

use App\Models\Response;
use Illuminate\Foundation\Http\FormRequest;

class ResponseRequest extends FormRequest
{

    public function authorize():bool
    {
        return $this->user()->can('create-responses', Response::class);
    }


    public function rules():array
    {
        return [
            'file'=>'required|max:90000|mimes:xlsx,doc,docx,ppt,pptx,pdf,ods,odt,odp',
            'title' => 'required|string|max:255',
            'assignment_id' => 'required|numeric|exists:assignments,id',
            'user_id' => 'required|numeric|exists:users,id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id()
        ]);
    }
}
