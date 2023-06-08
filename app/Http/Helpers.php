<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\MenuHead;
use App\Models\Admin\Menu;

if (!function_exists('has_access')) {
    function has_access($menu_key) {
        if (Auth::check()) {
            $menu_role = DB::table('menu_role')
            ->where('role_id',  Auth::user()->role->id)
            ->where('menu_key', $menu_key)
            ->where('status', 1)
            ->first();

            if($menu_role){
                $menu = Menu::where('key', $menu_key)->first();
                if($menu && $menu->status==1 && $menu->menu_head->status==1){
                    return true;
                }
                return false;
            }
            
            return false;
        }
        return false;
    }
}

if (!function_exists('has_menu')) {
    function has_menu($menu_head_key) {
        if (Auth::check()) {
            $menu_roles = DB::table('menu_role')
            ->where('role_id',  Auth::user()->role->id)
            ->where('menu_head_key', $menu_head_key)
            ->where('status', 1)
            ->get();

            if($menu_roles && count($menu_roles)>0){
                $menuHead = MenuHead::where('key', $menu_head_key)->first();
                if($menuHead && $menuHead->status==1){
                    return true;
                }
                return false;
            }
            
            return false;
        }
        return false;
    }
}