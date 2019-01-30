<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'password' => ['required', 'min:8', 'max:15']
        ];
    }

    public function messages() {
        return [
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上15文字以内で入力してください',
            'password.max' => 'パスワードは8文字以上15文字以内で入力してください',
        ];
    }
}
