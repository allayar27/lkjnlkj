<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check();
    }


    public function rules()
    {
        return [
            'message'=>'required',
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'assignment_id' => 'required|numeric|exists:App\Models\Assignment,id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id()
        ]);
    }
}
