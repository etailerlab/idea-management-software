<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\Role;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getRoles() as $role => $roleName) {
            Role::create(
                [
                    'name' => $role,
                    'display_name' => $roleName,
                ]
            );
        }
    }

    protected function getRoles()
    {
        return [
            'user' => 'User',
            'admin' => 'Admin',
            'superadmin' => 'Super Admin',
        ];
    }
}
