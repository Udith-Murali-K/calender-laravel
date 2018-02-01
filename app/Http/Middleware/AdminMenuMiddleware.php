<?php

namespace App\Http\Middleware;


use App\Menus\BuildAdminMenu;
use Closure;
use Auth;
use Menu;
use App\Menus\MenuFactory;

class AdminMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax() && Auth::check()){
            /* Build Menus */
            $sideBar = Menu::make('sidebar', function($menu){
                $menuProcessor = MenuFactory::getProcessor(Auth::user()->role_id);
                $menuProcessor->process($menu);
            });
//            BuildAdminMenu::render($sideBar);
        }
        return $next($request);
    }
}