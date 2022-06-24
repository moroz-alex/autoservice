<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Settings>
 */
class SettingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_name' => 'ООО "Рога и копыта"',
            'address' => 'д. Адидасовка, Гонконговский р-н., Одесская обл., ул. О. Бендера, 33',
            'phones' => '(050) 123-45-67, (067) 876-54-32',
            'work_days' => '1,2,3,4,5,6,7',
            'schedule_start' => '09:00',
            'schedule_end' => '18:00',
        ];
    }
}
