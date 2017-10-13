<?php

use Illuminate\Database\Seeder;
use App\Models\Categories\OperationalGoal;

class OperationGoalsTableSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getItems() as $item) {
            OperationalGoal::create(
                [
                    'name' => $item
                ]
            );
        }
    }

    protected function getItems()
    {
        return [
            'Вступление в ПВТ',
            'Удовлетворенность клиентов',
            'Удовлетворенность сотрудников',
            'Другая',
        ];
    }
}
