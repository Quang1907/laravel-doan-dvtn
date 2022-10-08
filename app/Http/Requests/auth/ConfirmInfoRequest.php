<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmInfoRequest extends FormRequest
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
            "phonenumber" => "required|min:10|max:10",
            "birthday" => "required",
            "password" => "required|min:6",
            "confirm_password" => "required|same:password",
            "address" => "required",
        ];
    }

    public function messages()
    {
        return [
            "phonenumber.required" => "vui lòng không để trống",
            "phonenumber.min" => "không được quá 10 ký tự",
            "phonenumber.max" => "không được nhỏ hơn 10 ký tự",
            "birthday.required" => "vui lòng không để trống",
            "password.required" => "vui lòng không để trống",
            "password.min" => "không nhỏ hơn 6 ký tự",
            "confirm_password.required" => "vui lòng không để trống",
            "confirm_password.same" => "không chính xác",
            "address.required" => "vui lòng không để trống",
        ];
    }
}
