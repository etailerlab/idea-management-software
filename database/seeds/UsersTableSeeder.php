<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\{
    User,
    Role
};
use App\Models\Categories\Department;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            Role::ROLE_USER => Role::where('name', '=', Role::ROLE_USER)->first(),
            Role::ROLE_ADMIN => Role::where('name', '=', Role::ROLE_ADMIN)->first(),
            Role::ROLE_SUPERADMIN => Role::where('name', '=', Role::ROLE_SUPERADMIN)->first(),
        ];
        $department = Department::where('name', '=', 'Другой')->first();

        foreach ($this->getUsers() as $user) {
            $userModel = User::create(
                [
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'last_name' => $user['last_name'],
                    'password' => bcrypt($user['pass']),
                    'department_id' => $department->id,
                    'position_id' => 1,
                    'is_active' => 1,
                ]
            );
            $userModel->attachRole($roles[$user['role']]);
        }
    }


    protected function getUsers()
    {
        return [
            [
                'role' => Role::ROLE_SUPERADMIN,
                'name' => 'Иван',
                'last_name' => 'Иванов',
                'email' => 'ivan@example.com',
                'pass' => '123456',
            ],
        ];

    }
}
