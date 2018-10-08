<?php

namespace App\Http\Requests\Admin\Dev\Role;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'id' => 'required|exists:roles,id',
        ];
    }
    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
     public function messages()
        {
            return [
               'required' => '参数未填完整',
                'exists' => '数据错误'
            ];
        }
}
