<?php

namespace App\Http\Requests\Admin\Order;

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
            'car_id'=>'required|integer|exists:cars,id',
            'task_ids'=>'array|required',
            'task_ids.*'=>'integer|exists:tasks,id',
            'task_qts'=>'array|required',
            'task_qts.*'=>'integer|min:1',
            'task_prs'=>'array|required',
            'task_prs.*'=>'integer|min:1',
            'task_drs'=>'array|required',
            'task_drs.*'=>'integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'car_id.required' => 'Необходимо выбрать автомобиль',
            'car_id.integer' => 'Некорректный ID автомобиля',
            'car_id.exists' => 'Несуществующий ID автомобиля',
            'task_ids.required' => 'Необходимо выбрать хотя бы одну работу',
            'task_ids.*.exists' => 'Некорретный ID работы',
            'task_ids.*.integer' => 'Некорретный ID работы',
            'task_qts.required' => 'Необходимо указать количество работ',
            'task_qts.*.integer' => 'Некорретное количество работ',
            'task_qts.*.min' => 'Некорретное количество работ',
        ];
    }
}
