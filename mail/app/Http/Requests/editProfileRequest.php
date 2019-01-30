<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editProfileRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'max:10'],
            'department' => ['required'],
            'icon' => ['image', 'max:1000']
        ];
    }

    public function messages() {
        return [
            'name.required' => '名前を入力してください',
            'name.min' => '名前は2文字以上10文字未満で入力してください',
            'name.max' => '名前は2文字以上10文字未満で入力してください',
            'department.required' => '学科を入力してください',
            'icon.image' => '画像を選択してください',
            'icon.max' => '画像のサイズが大きすぎます'
        ];
    }
}
