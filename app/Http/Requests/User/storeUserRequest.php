<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class storeUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'image' => ':attribute phải là ảnh',
            'mimes' => ':attribute đúng định dạng kiểu ảnh',
            'max' => ':attribute phải bé hơn 1024',
            'min' => ':attribute không được nhỏ hơn 6 ký tự',
            'same' => ':attribute phải giống nhau',
            'unique' => ':attribute phải là duy nhất',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên người dùng',
            'email' => 'Địa chỉ email',
            'avatar' => 'Hình ảnh',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Mật khẩu'
        ];
    }
}
