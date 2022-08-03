<?php

namespace App\Http\Requests\User\Car;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'user_id' => 'required|integer|exists:users,id',
            'model_id' => 'required|integer|exists:car_models,id',
            'year' => 'integer|nullable|between:1940,' . date('Y'),
            'number' => 'string|nullable',
            'vin' => 'string|nullable',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Отсутствует ID пользователя',
            'user_id.integer' => 'Некорректный ID пользователя',
            'user_id.exists' => 'Недопустимый ID пользователя',
            'model_id.required' => 'Необходимо выбрать модель автомобиля',
            'model_id.integer' => 'Некорректный ID модели автомобиля',
            'model_id.exists' => 'Недопустимый ID модели автомобиля',
            'year.between' => 'Год выпуска должен быть между 1940 и ' . date('Y'),
            'number.string' => 'Некорректный номер автомобиля',
            'vin.string' => 'Некорректный VIN-код автомобиля',
        ];
    }
}
