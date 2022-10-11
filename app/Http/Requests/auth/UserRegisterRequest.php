<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            "email" => "required|email|unique:users",
            "birthday" => "required|date|date_format:Y-m-d",
            "password" => "required|min:6",
            "confirm_password" => "required|same:password",
            "phonenumber" => "required|max:10",
            "province" => "required",
            "district" => "required",
            "ward" => "required",
            "manager" => "required",
            "street" => "required",
        ];
    }

    public function messages() {
        return [
            "name.required" => "vui lòng không để trống",
            "name.max" => "vui lòng không quá 30 ký tự",
            "email.required" => "vui lòng không để trống",
            "email.email" => "không đúng định dạng",
            "email.unique" => "đã tồn tại",
            "birthday.required" => "vui lòng không để trống",
            "birthday.date_format" => "vui lòng kiểm tra lại",
            "password.required" => "vui lòng không để trống",
            "password.min" => "vui lòng không nhỏ hơn 6 ký tự",
            "password.password" => "không đúng định dạng",
            "confirm_password.required" => "vui lòng không để trống",
            "confirm_password.same" => "không chính xác",
            "phonenumber.required" => "vui lòng không để trống",
            "phonenumber.max" => "phải là 10 số",
            "province.required" => " ",
            "district.required" => " ",
            "ward.required" => " ",
            "manager.required" => " ",
            "street.required" => "vui lòng không để trống",
        ];
    }
}
