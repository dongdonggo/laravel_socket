<?php

namespace App\Http\Requests\Admin\Dev\Route;

use Illuminate\Foundation\Http\FormRequest;

class DeletePost extends FormRequest
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
            'id' => 'required|exists:routes,id'
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
            'required' => '参数未填完整',
            'exists' => '参数错误，数据不存在'
        ];
    }
}
