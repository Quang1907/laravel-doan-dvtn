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
            "password" => "required|max:20|min:6|string",
            "confirm_password" => "required|same:password",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Tên không được để trống",
            "email.required" => "Email không được để trống",
            "email.email" => "Email đã tồn tại trên hệ thống",
            "email.string" => "Email phải là chuỗi",
            "password.required" => "Mật khẩu không được để trống",
            "password.min" => "Mật khẩu không được nhỏ hơn 6 ký tự",
            "password.max" => "Mật khẩu không được lớn hơn 20 ký tự",
            "confirm_password.required" => "Nhập lại mật khẩu không được để trống",
            "confirm_password.same" => "Nhập lại mật khẩu không chính xác",
        ];
    }
}
