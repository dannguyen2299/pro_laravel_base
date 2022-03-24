<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5',
            'full'=>'required|min:4',
            'phone'=>'required|min:10|unique:users,phone',
        ];
    }
    public function messages()
    {
        return[
            'email.reuired'=>'Email không được để trống',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã tồn tại!',
            'password.reuired'=>'Password không được để trống',
            'password.min'=>'Password không được nhỏ hơn 5 kí tự',
            'full.reuired'=>'Họ và tên  không được để trống',
            'full.min'=>'Họ và tên  không được nhỏ hơn 5 kí tự',
            'phone.reuired'=>'Số điện thoại không được để trống',
            'phone.min'=>'Số điện thoại không được nhỏ hơn 10 kí tự',
            'phone.unique'=>'Số điện thoại đã tồn tại',
        ];
    }
}
