<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Career;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['career'] = Career::first();
        return view('admin.career.index', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([]);
        Career::createOrUpdate(
            [
                'id' => 1
            ],
            [
                'short_description' => $request->short_description,
                'long_descripiton' => $request->long_description
            ]
        );
        Toastr::success('Career Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return back();
    }
}
