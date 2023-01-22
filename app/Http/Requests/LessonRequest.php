<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check();
    }


    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:jpg,png,img,bmp,jpeg,gif|max:4096',
            'video' => 'required',
            'category_id' => 'required|numeric|exists:App\Models\Category,id'
        ];
    }
}
