<?php

namespace Database\Seeders;

use App\Models\LifeStyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LifeStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lifeStyles = [
            [
                'name' => 'طالب/ موظف جدولي الاسبوعي مزدحم',
            ],
            [
                'name' => 'طالب/موظف  جدولي الاسبوعي متوازن ',
            ],
            [
                'name' => 'متفرغ تماما',
                ],
            ];

        foreach ($lifeStyles as $lifeStyle) {
            LifeStyle::query()->create($lifeStyle);
        }

    }
}
