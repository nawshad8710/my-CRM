<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['banner'] = Banner::first();
        return view('admin.banner.list', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE AND UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function storeAndUpdate(Request $request)
    {
        $request->validate([]);
        $banner = Banner::first();
        $imageName = $banner->image || '';

        $image = $request->file('image');
        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $newImageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/banner')) {
                mkdir('assets/images/uploads/banner', 0777, true);
            }

            $image->move(public_path('assets/images/uploads/banner'), $newImageName);


            if ($imageName && file_exists(public_path('assets/images/uploads/banner/' . $imageName))) {
                unlink(public_path('assets/images/uploads/banner/' . $imageName));
            }

            $imageName = $newImageName;
        }
        Banner::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'heading' => $request->input('heading'),
                'short_description' => $request->input('short_description'),
                'image' => $imageName
            ]
        );
        Toastr::success('Banner Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}
