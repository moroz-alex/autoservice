<?php

namespace App\Http\Requests\Admin\Settings;

use App\Models\Settings;
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
        $days = implode(',', array_keys(Settings::getDays()));

        return [
            'id' => 'required|integer',
            'company_name' => 'required|string',
            'address' => 'present',
            'phones' => 'present',
            'work_days' => 'required|array',
            'work_days.*'=>'integer|in:' . $days,
            'schedule_start' => '',
            'schedule_end' => '',
            'api_key' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Необходимо указать название организации',
            'work_days.required' => 'Необходимо выбрать рабочие дни',
            'schedule_start.required' => 'Необходимо выбрать время начала рабочего дня',
            'schedule_end.required' => 'Необходимо выбрать время окончания рабочего дня',
        ];
    }
}
