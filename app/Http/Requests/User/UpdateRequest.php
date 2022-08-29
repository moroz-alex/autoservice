<?php

namespace App\Http\Requests\User;

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
            'id' => 'required|integer|exists:users,id',
            'name' => 'required|string',
            'last_name' => 'string|nullable',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'phone' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Необходимо указать имя пользователя',
            'email.required' => 'Необходимо указать емейл',
            'email.email' => 'Указан некорректный емейл',
            'email.unique' => 'Пользователь с данным емейл-ом уже существует',
            'phone.required' => 'Необходимо указать номер телефона',
        ];
    }
}
