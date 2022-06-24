<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreRequest extends FormRequest
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
        $roles = implode(',',array_keys(User::getRoles()));

        return [
            'name' => 'required|string',
            'last_name' => 'string|nullable',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string', // можно ограничить регуляркой
            'phone' => 'required|string|unique:users,phone', // можно проверить регуляркой
            'role' => 'required|in:' . $roles,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Необходимо указать имя пользователя',
            'email.required' => 'Необходимо указать емейл',
            'email.email' => 'Указан некорректный емейл',
            'email.unique' => 'Пользователь с данным емейл-ом уже существует',
            'password.required' => 'Необходимо указать пароль',
            'phone.required' => 'Необходимо указать номер телефона',
            'phone.unique' => 'Пользователь с данным телефоном уже существует',
            'role.required' => 'Необходимо выбрать роль пользователя',
            'role.in' => 'Недопустимый идентификатор роли пользователя',
        ];
    }
}
