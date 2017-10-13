<?php

namespace App\Repositories;

use App\Models\Categories\Type as ModelType;

/**
 * Class Role
 * @package App\Repositories
 */
class Type extends AbstractRepository
{
    /**
     * @return string
     */
    protected function getModelClass() : string
    {
        return ModelType::class;
    }
}