<?php

namespace App\Repositories;

use App\Models\Categories\Position as ModelPosition;

/**
 * Class Position
 * @package App\Repositories
 */
class Position extends AbstractRepository
{
    /**
     * @return string
     */
    protected function getModelClass() : string
    {
        return ModelPosition::class;
    }
}