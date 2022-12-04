<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            "title" => "required",
            "content" => "required",
            "category_id" => "required",
        ];
    }
    
    public function messages()
    {
        return [
            "title.required" => "Title cannot be blank",
            "content.required" => "Content cannot be blank",
            "category_id.required" => "Category cannot be blank",
        ];
    }
}
