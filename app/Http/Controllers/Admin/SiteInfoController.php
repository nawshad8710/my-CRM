<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteInfo;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    |INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['siteInfo'] = SiteInfo::first();
        return view('admin.site-info.index',$data);
    }



    /*
    |--------------------------------------------------------------------------
    |STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([]);

        SiteInfo::updateOrCreate([
            ['id' => 1],
            [
                'title'                 => $request->title,
                'sub_title'             => $request->sub_title,
                'short_description'     => $request->short_description,
                'phone'                 => $request->phone,
                'email'                 => $request->email,
                'address'               => $request->address,
                'google_map_url'        => $request->google_map_url,
                'copyright_text'        => $request->copyright_text,
                'meta_keyword'          => $request->copyright_text,
                'meta_description'      => $request->meta_description,
                'vat'                   => $request->vat,
            ]
        ]);
        Toastr::success('Site Info Updated Successfully!', 'success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.site-info.index');
    }
}
