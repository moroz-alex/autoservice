<?php

namespace App\Http\Requests\Admin\Order\Part;

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
            'parts_codes' => 'array',
            'parts_codes.*' => 'string|max:20|nullable',
            'parts_titles' => 'array',
            'parts_titles.*' => 'string|nullable',
            'parts_prices' => 'array',
            'parts_prices.*' => 'integer|nullable',
            'parts_qts' => 'array',
            'parts_qts.*' => 'integer|nullable',
        ];
    }

    public function messages()
    {
        return [
            'parts_codes.*.string' => 'Некорректный код материала',
            'parts_titles.*.string' => 'Некорректное название материала',
            'parts_prices.*.integer' => 'Некорректная цена материала',
            'parts_qts.*.integer' => 'Некорректное количество материалов',
        ];
    }
}
