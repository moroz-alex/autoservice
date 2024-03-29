<?php

namespace App\Http\Requests\Admin\Task;

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
            'code' => 'string|max:20|nullable',
            'title'=>'required|string',
            'duration'=>'required|integer',
            'price'=>'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'is_available_to_customer' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'code.max' => 'Максимальная длина кода 20 символов',
            'title.required' => 'Необходимо указать название работы',
            'duration.required' => 'Необходимо указать продолжительность работы',
            'duration.integer' => 'Продолжительность работы должна быть целым числом (количество минут)',
            'price.required' => 'Необходимо указать стоимость нормочаса',
            'price.integer' => 'Стоимость нормочаса должна быть целым числом (в гривнах)',
            'category_id.required' => 'Необходимо выбрать категорию работы',
            'category_id.integer' => 'Некорректный идентификатор категории',
            'category_id.exists' => 'Категория не найдена',
            'is_available_to_customer' => 'Некорректный статус доступности работы к самостоятельному заказу клиентом',
        ];
    }
}
