<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SocialLink;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    |INDEX (METHOD)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['socialLinks'] = SocialLink::get();
        return view('admin.social-link.index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    |CREATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.social-link.form');
    }

    /*
    |--------------------------------------------------------------------------
    |STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([]);
        SocialLink::create([
            'url'                   => $request->url,
            'icon'                  => $request->icon,
            'background_color'      => $request->background_color,
            'foreground_color'      => $request->foreground_color,
        ]);
        Toastr::success('Social Link Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.social-link.index');
    }

    /*
    |--------------------------------------------------------------------------
    |EDIT (METHOD)
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['socialLink'] = SocialLink::find($id);
        return view('admin.social-link.form', $data);
    }

    /*
    |--------------------------------------------------------------------------
    |UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([]);
        $socialLink = SocialLink::find($id);
        $socialLink->update([
            'url'                   => $request->url,
            'icon'                  => $request->icon,
            'background_color'      => $request->background_color,
            'foreground_color'      => $request->foreground_color,
        ]);

        Toastr::success('Social Link Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.social-link.index');
    }


    public function delete($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->delete();
    }
}
