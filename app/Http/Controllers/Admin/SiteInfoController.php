<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteInfo;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
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
        return view('admin.site-info.index', $data);
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

        $siteInfo = SiteInfo::first();
        if($siteInfo)
        {
            $logoName = $siteInfo->logo;
        $favIconName = $siteInfo->fav_icon;

        $logo = $request->file('logo');
        $favIcon = $request->file('fav_icon');
        if ($logo) {
            $currentDate = Carbon::now()->toDateString();
            $newLogoName = $currentDate . '-' . uniqid() . '.' . $logo->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/site-info/logo')) {
                mkdir('assets/images/uploads/site-info/logo', 0777, true);
            }

            $logo->move(public_path('assets/images/uploads/site-info/logo'), $newLogoName);

            // Delete the previous icon file
            if ($logoName && file_exists(public_path('assets/images/uploads/site-info/logo/' . $logoName))) {
                unlink(public_path('assets/images/uploads/site-info/logo/' . $logoName));
            }

            $logoName = $newLogoName; // Update the icon name
        }
        if ($favIcon) {
            $currentDate = Carbon::now()->toDateString();
            $newFavIconName = $currentDate . '-' . uniqid() . '.' . $favIcon->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/site-info/fav-icon')) {
                mkdir('assets/images/uploads/site-info/fav-icon', 0777, true);
            }

            $favIcon->move(public_path('assets/images/uploads/site-info/fav-icon'), $newFavIconName);

            // Delete the previous icon file
            if ($favIconName && file_exists(public_path('assets/images/uploads/site-info/fav-icon/' . $favIconName))) {
                unlink(public_path('assets/images/uploads/site-info/fav-icon/' . $favIconName));
            }

            $favIconName = $newFavIconName; // Update the icon name
        }
        }



        SiteInfo::updateOrCreate(
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
                'meta_keyword'          => $request->meta_keyword,
                'meta_description'      => $request->meta_description,
                'vat'                   => $request->vat,
                'logo'                  => $logoName,
                'fav_icon'              => $favIconName
            ]
        );
        Toastr::success('Site Info Updated Successfully!', 'success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.site-info.index');
    }
}
