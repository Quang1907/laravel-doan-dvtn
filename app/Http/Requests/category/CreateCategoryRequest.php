<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|unique:categories",
            "description" => "required",
            "imageFile" => "nullable|mimes:png,jpg,jpeg",
            "meta_title" => "required|string",
            "meta_keyword" => "required|string",
            "meta_description" => "required|string",
        ];
    }

    public function messages() {
        return [
            "name.required" => "Category name cannot be blank",
            "name.unique" => "Category name exists",
            "name.unique" => "Category name exists",
        ];
    }
}
