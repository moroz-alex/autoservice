<?php

namespace App\Http\Requests\User\Order\Feedback;

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
            'rating' => 'required|integer|in:1,2,3,4,5',
            'review' => 'string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'rating.integer' => 'Некорректная оценка',
            'rating.in' => 'Некорректная оценка',
            'review.string' => 'Некорректная формат отзыва',
            'review.max' => 'Максимальная длина отзыва 1000 символов',
        ];
    }
}
