<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class postLoginRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn 6 ký tự'
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
        ];
    }
}
