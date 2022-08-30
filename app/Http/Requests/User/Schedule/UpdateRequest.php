<?php

namespace App\Http\Requests\User\Schedule;

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
            'order_id' => 'required|integer|exists:orders,id',
            'start_time' => 'required|date_format:Y-m-d H:i',
            'duration' => 'required|integer',
            'master_id' => 'nullable|integer|exists:masters,id',
        ];
    }

    public function messages()
    {
        return [
            'order_id.required' => 'Отсутствует ID заказа',
            'order_id.integer' => 'Некорректный ID заказа',
            'order_id.exists' => 'Несуществующий ID заказа',
            'start_time.required' => 'Необходимо выбрать дату и время начала работ',
            'start_time.date_format' => 'Некорректные дата и время начала работ',
            'duration.required' => 'Отсутствует длительность заказа',
            'duration.integer' => 'Некорректная длительность заказа',
            'master_id.integer' => 'Некорректный ID мастера',
            'master_id.exists' => 'Несуществующий ID мастера',
        ];
    }
}
