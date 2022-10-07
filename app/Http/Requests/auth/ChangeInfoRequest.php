<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangeInfoRequest extends FormRequest
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
            "name" => "required|max:30",
            "email" => "required|email|unique:users,email,". auth()->user()->id ,
            "birthday" => "required",
            "phonenumber" => "required|max:10",
        ];
    }

    public function messages() {
        return [
            "name.required" => "Họ và tên vui lòng không để trống",
            "name.max" => "Họ và tên vui lòng không quá 30 ký tự",
            "email.required" => "Email vui lòng không để trống",
            "email.email" => "Email không đúng định dạng",
            "email.unique" => "Email đã tồn tại trên hệ thống",
            "birthday.required" => "Ngày sinh vui lòng không để trống",
            "phonenumber.required" => "Số điện thoại vui lòng không để trống",
            "phonenumber.max" => "Số điện thoại phải là 10 số",
        ];
    }
}
