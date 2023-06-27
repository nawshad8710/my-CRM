<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\About;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['about'] = About::first();
        return view('admin.about.index', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([]);
        About::createOrUpdate(
            [
                'id' => 1
            ],
            [
                'short_description' => $request->short_description,
                'long_descripiton' => $request->long_description
            ]
        );
        Toastr::success('About Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return back();
    }
}
