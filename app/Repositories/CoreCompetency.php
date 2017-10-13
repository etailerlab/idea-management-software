<?php

namespace App\Repositories;

use App\Models\Categories\CoreCompetency as ModelCoreCompetency;

/**
 * Class Role
 * @package App\Repositories
 */
class CoreCompetency extends AbstractRepository
{
    /**
     * @return string
     */
    protected function getModelClass() : string
    {
        return ModelCoreCompetency::class;
    }
}