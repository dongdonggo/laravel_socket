<?php

namespace App\Http\Requests\Admin\Dev\Route;

use Illuminate\Foundation\Http\FormRequest;

class CreatePost extends FormRequest
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
            'action' => 'required|bail|unique:routes',
            'description' => 'max:255',
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '参数未填完整',
            'action.unique'  => '路径已存在，请勿重复添加',
        ];
    }
}
