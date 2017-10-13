<?php

namespace App\Widgets;

use Illuminate\Contracts\View\View;
use Spatie\Menu\Laravel\MenuFacade as Menu;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\Role;

/**
 * Class Navbar
 * @package App\Widgets
 */
class Navbar {

    /**
     * @param View $view
     */
    public function compose(View $view){

        Menu::macro('main', function () {
            $menu = Menu::new()
                ->addClass('nav navbar-nav');
            $user = Auth::user();
            if (isset($user)) {
                $menu
                    ->route('main', 'Идеи')
                    ->route('priority-board', 'Приоритетный список');
                if ($user->hasRole(Role::ROLE_SUPERADMIN)) {
                    $menu
                        ->route('pending-review', 'Ожидающие')
                        ->route('declined', 'Отклоненные')
                        ->route('users.index', 'Пользователи')
                        ->route('categories.index', 'Категории')
                    ;
                }
                $menu
                    ->route('add-idea', '+ Добавить идею')
                    ->setActiveFromRequest();
            }

            return $menu;
        });
    }
}