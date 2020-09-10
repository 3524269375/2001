<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
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
            //
            'brand_name' =>[
                'required',
                Rule::unique('brand')->ignore(request()->brand_id,'brand_id'),
            ],
            'brand_url' => 'required',
            'brand_desc'=>'required'
        ];
    }
    public function messages(){
    return [
        'brand_name.required' => '品牌名称不能为空',
        'brand_name.unique' => '品牌名称已存在',
        'brand_url.required' => '品牌网址不能为空',
        'brand_desc.required' => '品牌简介不能为空'
    ];
    }
}
