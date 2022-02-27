<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class storeRequestProduct extends FormRequest
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
            'price' => 'required',
            // 'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => 'attribute phải đúng kiểu định dạng',
            'max' => ': attribute phải bé hơn 1 mb',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá sản phẩm',
            'avatar' => 'Hình ảnh',
        ];
    }
}
