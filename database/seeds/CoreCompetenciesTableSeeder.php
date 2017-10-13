<?php

use Illuminate\Database\Seeder;
use App\Models\Categories\CoreCompetency;

class CoreCompetenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getItems() as $item) {
            CoreCompetency::create(
                [
                    'name' => $item
                ]
            );
        }
    }

    protected function getItems()
    {
        return [
            'Кадры',
            'Разработка',
            'Продажи',
            'Другая',
        ];
    }
}
