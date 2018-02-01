<?php

namespace App\Menus;

use Route;

class BuildAdminMenu
{
    public static function render(\Caffeinated\Menus\Builder $menu)
    {
        $routeName = Route::currentRouteName();
        /* Setting up Active Menu */
        foreach ($menu->all() as $item) {
            if (isset($item->link->path->route) && $item->link->path->route && $item->link->path->route == $routeName) {
                $item->activate();
            }
            if ($item->hasChildren()) {
                $item->attribute('class', $item->attribute('class') . ' treeview');
            }
        }
        return $s = self::traverse($menu);
    }

    private static function traverse($menu, $parent = null)
    {
        $items = "";
        foreach ($menu->whereParent($parent) as $item) {
            $items .= "<li {$item->attributes()}>";
            if ($item->link) {
                $items .= "<a{$menu->attributes($item->link->attr())} href=\"{$item->url()}\">{$item->prependIcon()->title}</a>";
            } else {
                $items .= $item->title;
            }

            if ($item->hasChildren()) {
                $items .= "<ul class='treeview-menu'>";
                $items .= self::traverse($menu, $item->id);
                $items .= "</ul>";
            }
            $items .= "</li>";
            if ($item->divider) {
                $items .= "<li {$menu->attributes($item->divider)}></li>";
            }
        }
        return $items;
    }
}