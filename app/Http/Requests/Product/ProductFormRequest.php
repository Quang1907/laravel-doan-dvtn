<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            "name"=> "required|string",
            "imageFile"=> "nullable",
            "category_id"=> "required|integer",
            "brand"=> "required|integer",
            "small_description"=> "required",
            "description"=> "required|string",
            "original_price"=> "required|integer",
            "selling_price"=> "required|integer",
            "quantity"=> "required|integer",
            "trending"=> "nullable",
            "status"=> "nullable",
            "meta_title"=> "required|max:255",
            "meta_description"=> "required|string",
            "meta_keyword" => "required|string",
            "colors" => "nullable",
            "color_quantity" => "nullable",
        ];
    }
}
