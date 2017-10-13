<?php

namespace App\Models\Auth;

use Zizaco\Entrust\EntrustRole;

/**
 * Class Role
 * @package App\Models\Auth
 */
class Role extends EntrustRole
{
    const ROLE_SUPERADMIN = 'superadmin';
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    /**
     * @return string
     */
    public function getDisplayNameField() : string
    {
        return $this->display_name;
    }
}
