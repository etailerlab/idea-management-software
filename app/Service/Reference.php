<?php

namespace App\Service;

use Illuminate\Support\Facades\App;

/**
 * Class Reference
 * @package App\Service
 */
class Reference
{
    /**
     * @param bool $isActive
     * @param string $sortField
     * @param string $order
     * @return array
     */
    public function getAllCoreCompetencyForSelect($isActive = true, $sortField = 'id', $order = 'asc') : array
    {
        return (App::make('repository.coreCompetency'))->getAllForSelect($isActive, $sortField, $order);
    }

    /**
     * @param bool $isActive
     * @param string $sortField
     * @param string $order
     * @return array
     */
    public function getAllOperationalGoalForSelect($isActive = true, $sortField = 'id', $order = 'asc') : array
    {
        return (App::make('repository.operationalGoal'))->getAllForSelect($isActive, $sortField, $order);
    }

    /**
     * @param bool $isActive
     * @param string $sortField
     * @param string $order
     * @return array
     */
    public function getAllStrategicObjectiveForSelect($isActive = true, $sortField = 'id', $order = 'asc') : array
    {
        return (App::make('repository.strategicObjective'))->getAllForSelect($isActive, $sortField, $order);
    }
    /**
     * @param bool $isActive
     * @param string $sortField
     * @param string $order
     * @return array
     */
    public function getAllTypeForSelect($isActive = true, $sortField = 'id', $order = 'asc') : array
    {
        return (App::make('repository.type'))->getAllForSelect($isActive, $sortField, $order);
    }

    /**
     * @param bool $isActive
     * @param string $sortField
     * @param string $order
     * @return array
     */
    public function getAllDepartmentForSelect($isActive = true, $sortField = 'id', $order = 'asc') : array
    {
        return (App::make('repository.department'))->getAllForSelect($isActive, $sortField, $order);
    }

    /**
     * @param string $sortField
     * @param string $order
     * @return array
     */
    public function getAllRolesForSelect($sortField = 'id', $order = 'asc') : array
    {
        return (App::make('repository.role'))->getAllForSelect(false, $sortField, $order);
    }

    /**
     * @param bool $isActive
     * @param string $sortField
     * @param string $order
     * @return array
     */
    public function getAllStatusesForSelect($isActive = true, $sortField = 'id', $order = 'asc') : array
    {
        return (App::make('repository.status'))->getAllForSelect($isActive, $sortField, $order);
    }

    /**
     * @param bool $isActive
     * @param string $sortField
     * @param string $order
     * @return array
     */
    public function getAllPositionsForSelect($isActive = true, $sortField = 'id', $order = 'asc') : array
    {
        return (App::make('repository.position'))->getAllForSelect($isActive, $sortField, $order);
    }
}