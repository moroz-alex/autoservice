<?php

namespace App\Http\Requests\Admin\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'date_from'=>'date_format:Y-m-d',
            'date_to'=>'date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'date_from.date_format' => 'Некорректная дата начала периода',
            'date_to.date_format' => 'Некорректная дата конца периода',
        ];
    }
}