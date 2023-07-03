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
    | CREATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('');
    }
    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'short_description' => 'required',
            'long_description' => 'required'
        ]);
        Career::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'title' => $request->input('title'),
                'short_description' => $request->input('short_description'),
                'long_description' => $request->input('long_description')
            ]
        );
        Toastr::success('Career Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT (METHOD)
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
    }


    /*
    |--------------------------------------------------------------------------
    | Delete (METHOD)
    |--------------------------------------------------------------------------
    */
    public function delete($id)
    {

    }
}
