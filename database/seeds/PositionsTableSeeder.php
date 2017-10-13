<?php

use Illuminate\Database\Seeder;
use App\Models\Categories\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getItems() as $item) {
            Position::create(
                [
                    'name' => $item
                ]
            );
        }
    }

    protected function getItems()
    {
        return [
            'PHP разработчик',
            'Ruby разработчик',
            'UI/UX разработчик',
            'Менеджер по продажам',
            'Менеджер проектов',
            'Frontend разработчик',
            'Директор',
            'Технический директор',
        ];
    }
}
