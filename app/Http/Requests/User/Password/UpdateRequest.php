<?php

namespace App\Http\Requests\User\Password;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Необходимо указать текущий пароль пользователя',
            'password.current_password' => 'Текущий пароль неверный',
            'new_password.required' => 'Необходимо указать новый пароль',
            'new_password.string' => 'Неверный формат пароля',
            'new_password.min' => 'Пароль должен быть не менее 8 символов',
            'new_password.confirmed' => 'Пароль и подтверждение не совпадают',
        ];
    }
}
