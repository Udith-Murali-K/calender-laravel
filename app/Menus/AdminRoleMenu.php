<?php

namespace App\Menus;

class AdminRoleMenu extends AbstractRoleMenu
{

    public function process($menu)
    {
        $main = $menu->add('MAIN NAVIGATION');
        $home = $menu->add('Dashboard', array('route' => 'admin.get_home'))->icon('dashboard');
    }
}
