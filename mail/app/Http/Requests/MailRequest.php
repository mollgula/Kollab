<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'signup')
        {
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
            'mail' => ['required', 'email', 'unique:registers,mail', 'regex:/[k][d][0-9]{7}[@][s][t][.][k][o][b][e][d][e][n][s][h][i][.][a][c][.][j][p]/u'],
            'password' => ['required', 'min:8'],
            'confirm_password' => ['required', 'same:password', 'min:8'] ,
            'token' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'mail.required' => 'メールアドレスを入力してください',
            'mail.email' => 'メールアドレスの形式で書いてください',
            'mail.regex' => 'KDメールアドレスを利用してください',
            'mail.unique' => 'このメールアドレスは、すでに登録されています',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'confirm_password.min' => 'パスワードは8文字以上で入力してください',
            'confirm_password.required' => 'パスワード再確認を入力してください',
            'confirm_password.same' => 'パスワードが一致していません',
            'token.required' => 'ページを更新してください',
        ];
    }
}
