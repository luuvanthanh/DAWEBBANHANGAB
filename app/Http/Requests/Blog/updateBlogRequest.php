<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class updateBlogRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'description' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute phải đúng kiểu định dạng',
            'max' => ':attribute không được lớn hơn 1024',
        ];

    }

    public function attributes()
    {
        return [
            'title' => 'Tên Blog',
            'image' => 'Hình ảnh',
            'description' => 'Mô tả',
            'content' => 'Nội dung',
        ];
    }
}
