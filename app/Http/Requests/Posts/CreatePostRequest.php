<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            "image" => "required",
            "category_id" => "required",
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Vui lòng không để trống tiêu đề",
            "content.required" => "Vui lòng không để trống nội dung",
            "category_id.required" => "Vui lòng chọn danh mục",
            "image.required" => "Vui lòng tải lên hình ảnh",
        ];
    }
}
