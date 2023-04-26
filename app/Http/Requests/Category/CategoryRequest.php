<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize():bool
    {
        return $this->user()->can('create-categories', Category::class);
    }


    public function rules():array
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }
}
