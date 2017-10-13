<?php

namespace App\Repositories;

use App\Models\Auth\Role as ModelRole;

/**
 * Class Role
 * @package App\Repositories
 */
class Role extends AbstractRepository
{

    protected function getModelClass() : string
    {
        return ModelRole::class;
    }
}