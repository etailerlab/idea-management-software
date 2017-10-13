<?php

namespace App\Repositories;

use App\Models\Categories\Status as ModelStatus;

/**
 * Class Role
 * @package App\Repositories
 */
class Status extends AbstractRepository
{
    /**
     * @param string $slug
     * @return null | \App\Models\Categories\Status
     */
    public function getBySlug(string $slug)
    {
        return ModelStatus::where('slug', '=', $slug)->first();
    }

    /**
     * @return string
     */
    protected function getModelClass() : string
    {
        return ModelStatus::class;
    }
}