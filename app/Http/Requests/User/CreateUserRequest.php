<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            "name" => "required",
            "email" => "required|email|string",
            "role_id" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Tên không được để trống",
            "email.required" => "Email không được để trống",
            "email.email" => "Email đã tồn tại trên hệ thống",
            "email.string" => "Email phải là chuỗi",
        ];
    }
}
