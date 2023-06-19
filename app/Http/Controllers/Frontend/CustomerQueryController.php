<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerQuery;
use Illuminate\Http\Request;
Use Alert;

class CustomerQueryController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }




    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([]);

        CustomerQuery::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'subject'   => $request->message,
        ]);
        Alert::success('Success!', 'Submit Message');


        return back();
    }
}
