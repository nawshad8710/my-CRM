<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CookiePolicy;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CookiesPolicyController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['cookiePolicy'] = CookiePolicy::first();
        return view('admin.cookie-policy.index', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([]);
        CookiePolicy::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'long_description' => $request->long_description
            ]
        );
        Toastr::success('Cookie Policy Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
