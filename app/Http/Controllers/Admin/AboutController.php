<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\About;
use App\Models\Admin\AboutWhoWeAre;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
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


    /*
    |--------------------------------------------------------------------------
    | WHO WE ARE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function whoWeAre()
    {
        return view('admin.about.who-we-are');
    }

    /*
    |--------------------------------------------------------------------------
    | WHO WE ARE STORE AND UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function whoWeAreStore(Request $request)
    {
        $request->validate([]);
        $whoWeAre = AboutWhoWeAre::first();
        if ($whoWeAre) {
            $imageName = optional($whoWeAre)->image;

            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $NewImageName   = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


                if (!file_exists('assets/images/uploads/about/who-we-are')) {
                    mkdir('assets/images/uploads/about/who-we-are', 0777, true);
                }
                $image->move(public_path('assets/images/uploads/about/who-we-are'), $NewImageName);
                // Delete the previous icon file
                if ($imageName && file_exists(public_path('assets/images/uploads/about/who-we-are/' . $imageName))) {
                    unlink(public_path('assets/images/uploads/about/who-we-are/' . $imageName));
                }

                $imageName = $NewImageName;
            }
            $whoWeAre->updateOrCreate(
                [
                    'id' => 1
                ],
                [
                    'description' => $request->input('description'),
                    'image' => $imageName
                ]

            );

            Toastr::success('Who We Are Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.our-achive.form');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | OUR VISION (METHOD)
    |--------------------------------------------------------------------------
    */

    public function ourVision()
    {
        return view('admin.about.ourvision');
    }
    /*
    |--------------------------------------------------------------------------
    | OUR MISION (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourMision()
    {
        return view('admin.about.ourmision');
    }
    /*
    |--------------------------------------------------------------------------
    | OUR VISION STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR MISION STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM CREATE (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM EDIT (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM DELETE (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM  (METHOD)
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM CREATE  (METHOD)
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM STORE  (METHOD)
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM EDIT  (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM UPDATE  (METHOD)
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM DELETE  (METHOD)
    |--------------------------------------------------------------------------
    */
}
