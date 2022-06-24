<?php

namespace App\Rules\Order;

use App\Models\Master;
use Illuminate\Contracts\Validation\Rule;

class HasMaster implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $masters = Master::all();

        foreach ($masters as $master) {
            if (empty(array_diff($value, $master->tasks->pluck('id')->toArray()))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Нет мастера, способного выполнить все выбранные работы. Разделите работы на несколько заказов для разных мастеров.';
    }
}
