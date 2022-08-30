<?php

namespace Database\Seeders;

use App\Models\Settings;
use App\Models\State;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Settings::factory(1)->create();
        State::insert(
            [
                [
                    'title' => 'Новый',
                ],
                [
                    'title' => 'Принят',
                ],
                [
                    'title' => 'Выполнен',
                ],
                [
                    'title' => 'Отменен',
                ],
                [
                    'title' => 'Черновик',
                ],
            ]);
    }
}
