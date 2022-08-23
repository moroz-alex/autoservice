<?php

namespace App\Http\Requests\Admin\Order\State;

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
            'state' => 'nullable|integer|exists:states,id',
        ];
    }

    public function messages()
    {
        return [
            'state.integer' => 'Некорректный ID статуса',
            'state.exists' => 'Несуществующий ID статуса',
        ];
    }
}
