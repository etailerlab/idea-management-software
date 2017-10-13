<?php

namespace App\Repositories;

/**
 * Class AbstractRepository
 * @package App\Repositories
 */
abstract class AbstractRepository
{
    /**
     * @param string $order
     * @return array
     */
    public function getAllForSelect($isActive = true, $sortField = 'id', $order = 'asc') : array
    {
        $res = [];
        $query = ($this->getModelClass())::orderBy($sortField, $order);
        if ($isActive) {
            $query->where('is_active', '=', '1');
        }
        foreach ($query->get() as $model)
        {
            $name = $model->getDisplayNameField();

            if ($model->is_active === 0) {
                $name .= ' (устаревш.)';
            }
            $res[$model->id] = $name;
        }

        return $res;
    }

    /**
     * @return string
     */
    abstract protected function getModelClass() : string;
}