<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\privacyPolicy;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['privacyPolicy'] = privacyPolicy::first();
        return view('admin.privacy-policy.index', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([]);
        privacyPolicy::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'long_description' => $request->long_description
            ]
        );
        Toastr::success('Privacy Policy Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
