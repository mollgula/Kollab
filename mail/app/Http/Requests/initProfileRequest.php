<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class initProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path = "register/{token}") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'department' => ['required'],
            'schoolYear' => ['required']
        ];
    }

    public function messages() {
        return [
            'name.required' => '名前を入力してください',
            'department.required' => '学科を入力してください',
            'schoolYear.required' => '学年を入力してください'
        ];
    }
}
