<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TermsAndCondition;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['termsAndCondition'] = TermsAndCondition::first();
        return view('admin.terms-and-condition.index', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([]);
        TermsAndCondition::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'long_description' => $request->long_description
            ]
        );
        Toastr::success('Terms And Condition Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
