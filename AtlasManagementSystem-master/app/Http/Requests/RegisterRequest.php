<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'over_name' => 'string|required|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana'=> 'required|string|max:30|regex:/\A[ァ-ヴー]+\z/u',
            'under_name_kana'=> 'required|string|max:30|regex:/\A[ァ-ヴー]+\z/u',
            'mail_address'=> 'required|email|max:100|unique:users',
            'sex'=> 'required|in:1,2,3',
            'role'=> 'required|in:1,2,3,4',
            'date'=> 'required|date|before_or_equal:today',
            'old_year'=>'required_with:old_month,old_day|after_or_equal:2000',
            'old_month'=>'required_with:old_year,old_day',
            'old_day'=>'required_with:old_month,old_year',
            'password'=> 'required|min:8|max:30|string|regex:/\A([a-zA-Z0-9]{8,})+\z/u|confirmed',
            'password_confirmation'=> 'required',
        ];
    }

    public function messages(){
        return [
            'over_name.max' => '苗字は10文字以内で入力してください。',
            'under_name.max' => '名前は10文字以内で入力してください。',
            'over_name_kana.max' => 'フリガナは30文字以内で入力してください。',
            'over_name_kana.regex' => 'フリガナはカタカナで入力してください。',
            'under_name_kana.max' => 'フリガナは30文字以内で入力してください。',
            'under_name_kana.regex' => 'フリガナはカタカナで入力してください。',
            'mail_address.max' => 'メールアドレスは100文字以内で入力してください。',
            'mail_address.email' => 'メールアドレスはEメールで入力してください。',
            'mail_address.unique' => 'このメールアドレスはすでに使われています',
            'old_year.after' => '誕生日は2000年以降で入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは30文字以下で入力してください。',
            'password.regex' => 'パスワードは半角英数字で入力してください。',
            'password.confirmed' => '確認パスワードが一致していません。',

        ];
    }

    public function getValidatorInstance()
    {
        if ($this->input('old_day') && $this->input('old_month') && $this->input('old_year'))
        {
            $birthDate = implode('-', $this->only(['old_year', 'old_month', 'old_day']));
            $this->merge([
                'date' => $birthDate,
            ]);
        }

        return parent::getValidatorInstance();
    }
}
