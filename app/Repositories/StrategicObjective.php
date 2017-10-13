<?php

namespace App\Repositories;

use App\Models\Categories\StrategicObjective as ModelStrategicObjective;

/**
 * Class Role
 * @package App\Repositories
 */
class StrategicObjective extends AbstractRepository
{
    /**
     * @return string
     */
    protected function getModelClass() : string
    {
        return ModelStrategicObjective::class;
    }
}