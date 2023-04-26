<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{

    public function authorize():bool
    {
        return $this->user()->can('create', Comment::class);
    }


    public function rules():array
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
