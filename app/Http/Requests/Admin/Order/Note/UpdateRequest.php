<?php

namespace App\Http\Requests\Admin\Order\Note;

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
            'note' => 'string|max:1000|nullable',
        ];
    }

    public function messages()
    {
        return [
            'note.string' => 'Некорректный комментарий',
            'note.max' => 'Максимальная длина комментария 1000 символов',
        ];
    }
}
