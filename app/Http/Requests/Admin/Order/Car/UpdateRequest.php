<?php

namespace App\Http\Requests\Admin\Order\Car;

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
            'car_id' => 'required|integer|exists:cars,id',
        ];
    }

    public function messages()
    {
        return [
            'car_id.required' => 'Необходимо выбрать автомобиль',
            'car_id.integer' => 'Некорректный ID автомобиля',
            'car_id.exists' => 'Несуществующий ID автомобиля',
        ];
    }
}
