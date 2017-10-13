<?php

namespace App\Repositories;

use App\Models\Categories\Department as ModelDepartment;

/**
 * Class Department
 * @package App\Repositories
 */
class Department extends AbstractRepository
{
    protected function getModelClass() : string
    {
        return ModelDepartment::class;
    }
}