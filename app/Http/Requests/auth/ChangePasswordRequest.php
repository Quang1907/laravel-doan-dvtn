<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            "old_password" => "required",
            "password" => "required|min:6",
            "confirm_password" => "required|same:password"
        ];
    }

    public function messages()
    {
        return [
            "old_password.required" => "Mật khẩu cũ không được để trống",
            "password.required" => "Mật khẩu không được để trống",
            "password.min" => "Mật khẩu không được nhỏ hơn 6 ký tự",
            "confirm_password.required" => "Nhập lại mật khẩu không được để trống",
            "confirm_password.same" => "Nhập lại mật khẩu không chính xác",
        ];
    }
}
