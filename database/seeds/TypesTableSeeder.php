<?php

use Illuminate\Database\Seeder;
use App\Models\Categories\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getItems() as $item) {
            Type::create(
                [
                    'name' => $item
                ]
            );
        }
    }

    protected function getItems()
    {
        return [
            'Для компании',
            'Для отдела',
        ];
    }
}
