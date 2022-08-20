<?php

namespace App\Http\Requests\Admin\Order;

use App\Rules\Order\HasMaster;
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
            'car_id' => 'required|integer|exists:cars,id',
            'note' => 'string|max:1000|nullable',
            'task_ids' => ['array', 'required', new HasMaster],
            'task_ids.*' => 'integer|exists:tasks,id',
            'task_qts' => 'array|required',
            'task_qts.*' => 'integer|min:1',
            'task_prs' => 'array|required',
            'task_prs.*' => 'integer|min:1',
            'task_drs' => 'array|required',
            'task_drs.*' => 'integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'car_id.required' => 'Необходимо выбрать автомобиль',
            'car_id.integer' => 'Некорректный ID автомобиля',
            'car_id.exists' => 'Несуществующий ID автомобиля',
            'note.string' => 'Некорректный комментарий',
            'note.max' => 'Максимальная длина комментария 1000 символов',
            'task_ids.required' => 'Необходимо выбрать хотя бы одну работу',
            'task_ids.*.exists' => 'Некорректный ID работы',
            'task_ids.*.integer' => 'Некорректный ID работы',
            'task_qts.required' => 'Необходимо указать количество работ',
            'task_qts.*.integer' => 'Некорректное количество работ',
            'task_qts.*.min' => 'Некорректное количество работ',
            'task_prs.required' => 'Необходимо указать цену работы',
            'task_prs.*.integer' => 'Некорректная цена работы',
            'task_prs.*.min' => 'Некорректная цена работы',
            'task_drs.required' => 'Необходимо указать продолжительность работы',
            'task_drs.*.integer' => 'Некорректная продолжительность работы',
            'task_drs.*.min' => 'Некорректная продолжительность работы',
        ];
    }
}
