<?php

namespace App\Widgets;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;

/**
 * Class TopUsers
 * @package App\Widgets
 */
class TopUsers {

    /**
     * @param View $view
     */
    public function compose(View $view){

        $view->with('topUsers', $this);
    }

    /**
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function get(int $limit = 3)
    {
        return App::make('repository.user')->getTopUsers($limit);
    }
}