<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*
        if($this->path() == 'password_reset')
        {
            return true;
        } else {
            return false;
        }
        */
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
            'mail' => ['required', 'email', 'regex:/[k][d][0-9]{7}[@][s][t][.][k][o][b][e][d][e][n][s][h][i][.][a][c][.][j][p]/u'],
            'token' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'mail.required' => 'KDメールアドレスを入力してください',
            'mail.email' => 'メールアドレスの形で入力してください',
            'mail.regex' => 'KDメールアドレスで入力してください',
            'token.required' => '新しいページでやり直してください',
        ];
    }
}
