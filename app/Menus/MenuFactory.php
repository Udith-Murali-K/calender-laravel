<?php

namespace App\Menus;

use App\Common\Roles;

class MenuFactory
{
    public static function getProcessor($role_id){
        if ($role_id == Roles::ROLE_ADMIN) {
            return new AdminRoleMenu();
        }
    }
}