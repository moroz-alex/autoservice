<?php

namespace App\Http\Requests\Admin\Master;

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
            'first_name'=>'required|string',
            'last_name'=>'string|nullable',
            'task_ids'=>'array|required',
            'task_ids.*'=>'integer|exists:tasks,id',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Необходимо указать имя мастера',
            'first_name.string' => 'Имя мастера должно быть строкой',
            'last_name.string' => 'Фамилия мастера должна быть строкой',
            'task_ids.required' => 'Необходимо выбрать хотя бы одну работу',
            'task_ids.*.exists' => 'Некорретный ID работы',
            'task_ids.*.integer' => 'Некорретный ID работы',
        ];
    }
}
