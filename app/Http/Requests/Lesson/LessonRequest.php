<?php

namespace App\Http\Requests\Lesson;

use App\Models\Lesson;
use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->can('create-lessons', Lesson::class);
    }


    public function rules(): array
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
