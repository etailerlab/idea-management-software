<?php

use Illuminate\Database\Seeder;
use App\Models\Categories\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getDepartments() as $department) {
            Department::create(
                [
                    'name' => $department
                ]
            );
        }
    }

    protected function getDepartments()
    {
        return [
            'PHP разработки',
            'Ruby разработки',
            'Frontend разработки',
            'UI/UX',
            'Маркетинга и продаж',
            'Кадров',
            'Другой',
        ];
    }
}
