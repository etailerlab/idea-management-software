<?php

namespace App\Repositories;

use App\Models\Categories\OperationalGoal as ModelOperationalGoal;

/**
 * Class Role
 * @package App\Repositories
 */
class OperationalGoal extends AbstractRepository
{
    /**
     * @return string
     */
    protected function getModelClass() : string
    {
        return ModelOperationalGoal::class;
    }
}