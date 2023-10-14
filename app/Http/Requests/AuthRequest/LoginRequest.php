<?php

namespace App\Http\Requests\AuthRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // protected $redirect = '/dang-nhap';


      protected function failedValidation(Validator $validator)
    {
        session()->flash('error', 'Vui lòng kiểm tra lại thông tin');
        return parent::failedValidation($validator);
    }

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
    {        $this->redirect = url()->previous();

        return [
            'email' => 'required',
            'password' => [
                'required',
                'min:6',
                'max:25',             
            ]
        ];
    }
    // public function messages()
    // {
    //    return config("validation_message");
    // }
}
