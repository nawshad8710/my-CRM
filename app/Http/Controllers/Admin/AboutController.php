<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\About;
use App\Models\Admin\AboutOurMision;
use App\Models\Admin\AboutOurMisionItem;
use App\Models\Admin\AboutOurVision;
use App\Models\Admin\AboutOurVisionItem;
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
        $data['whoWeAre'] = AboutWhoWeAre::first();
        return view('admin.about.who-we-are', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | WHO WE ARE STORE AND UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function whoWeAreStore(Request $request)
    {
        // dd($request->all());
        $request->validate([]);
        $whoWeAre = AboutWhoWeAre::first();

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
            // dd($imageName);
        }
        AboutWhoWeAre::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'description' => $request->input('description'),
                'image' => $imageName
            ]

        );

        Toastr::success('Who We Are Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | OUR VISION (METHOD)
    |--------------------------------------------------------------------------
    */

    public function ourVision()
    {
        $data['ourVision'] = AboutOurVision::first();
        return view('admin.about.ourvision', $data);
    }
    /*
    |--------------------------------------------------------------------------
    | OUR MISION (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourMision()
    {
        $data['ourMision'] = AboutOurMision::first();
        return view('admin.about.ourmision', $data);
    }
    /*
    |--------------------------------------------------------------------------
    | OUR VISION STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourVisionStore(Request $request)
    {
        $request->validate([]);
        $ourVision = AboutOurVision::first();

            $imageName = optional($ourVision)->image;

            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $NewImageName   = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


                if (!file_exists('assets/images/uploads/about/our-vision')) {
                    mkdir('assets/images/uploads/about/our-vision', 0777, true);
                }
                $image->move(public_path('assets/images/uploads/about/our-vision'), $NewImageName);
                // Delete the previous icon file
                if ($imageName && file_exists(public_path('assets/images/uploads/about/our-vision/' . $imageName))) {
                    unlink(public_path('assets/images/uploads/about/our-vision/' . $imageName));
                }

                $imageName = $NewImageName;
            }
            AboutOurVision::updateOrCreate(
                [
                    'id' => 1
                ],
                [
                    'description' => $request->input('description'),
                    'image' => $imageName
                ]

            );

            Toastr::success('Our Vision Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();

    }
    /*
    |--------------------------------------------------------------------------
    | OUR MISION STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourMisionStore(Request $request)
    {
        $request->validate([]);
        $ourMision = AboutOurMision::first();

            $imageName = optional($ourMision)->image;

            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $NewImageName   = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


                if (!file_exists('assets/images/uploads/about/our-mision')) {
                    mkdir('assets/images/uploads/about/our-mision', 0777, true);
                }
                $image->move(public_path('assets/images/uploads/about/our-mision'), $NewImageName);
                // Delete the previous icon file
                if ($imageName && file_exists(public_path('assets/images/uploads/about/our-mision/' . $imageName))) {
                    unlink(public_path('assets/images/uploads/about/our-mision/' . $imageName));
                }

                $imageName = $NewImageName;
            }
           AboutOurMision::updateOrCreate(
                [
                    'id' => 1
                ],
                [
                    'description' => $request->input('description'),
                    'image' => $imageName
                ]

            );

            Toastr::success('Our Mision Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();

    }
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourVisionItem()
    {
        $data['data'] = AboutOurVisionItem::get();
        return view('admin.about.ourvision-item', $data);
    }
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM CREATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourVisionItemCreate()
    {
        return view('admin.about.ourvision-item-form');
    }
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourVisionItemStore(Request $request)
    {
        // dd($request->all());
        $request->validate([]);


        $imageName = '';
        $image = $request->file('image');
        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $imageName   = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


            if (!file_exists('assets/images/uploads/about/our-vision-item')) {
                mkdir('assets/images/uploads/our-vision-item', 0777, true);
            }
            $image->move(public_path('assets/images/uploads/our-vision-item'), $imageName);
        }

        AboutOurVisionItem::create(

            [
                'our_vision_id'             => 1,
                'title'                     => $request->title,
                'short_description'         => $request->short_description,
                'image'                     => $imageName
            ]
        );

        Toastr::success('Our Vision Item Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.about.ourVisionItem');
    }
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM EDIT (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourVisionItemEdit($id)
    {
        $data['ourVisionItem'] = AboutOurVisionItem::findOrFail($id);
        return view('admin.about.ourvision-item-form', $data);
    }
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourVisionItemUpdate(Request $request, $id)
    { {
            $ourVision = AboutOurVisionItem::find($id);
            $request->validate([]);
            $imageName = $ourVision->image;

            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $newImageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                if (!file_exists('assets/images/uploads/our-vision-item')) {
                    mkdir('assets/images/uploads/our-vision-item', 0777, true);
                }

                $image->move(public_path('assets/images/uploads/our-vision-item'), $newImageName);


                if ($imageName && file_exists(public_path('assets/images/uploads/our-vision-item/' . $imageName))) {
                    unlink(public_path('assets/images/uploads/our-vision-item/' . $imageName));
                }

                $imageName = $newImageName;
            }

            $ourVision->update([
                'our_vision_id'             => 1,
                'title'                     => $request->title,
                'short_description'         => $request->short_description,
                'image'                     => $imageName
            ]);
            Toastr::success('Our Vision Item Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('admin.our-team.index');
        }
    }
    /*
    |--------------------------------------------------------------------------
    | OUR VISION ITEM DELETE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourVisionItemDelete($id)
    {
        $ourVisionItem = AboutOurVisionItem::find($id);
        if ($ourVisionItem) {

            // dd($ourTeam->image);
            if ($ourVisionItem->image !== "") {
                $imagePath = public_path('assets/images/uploads/our-vision-item/' . $ourVisionItem->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            } else {
                $ourVisionItem->delete();
            }
            $ourVisionItem->delete();
            Toastr::success('Our Vision Item Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM  (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourMisionItem()
    {
        $data['ourMisionItem'] = AboutOurMisionItem::get();
        return view('admin.about.ourmision-item', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM CREATE  (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourMisionItemCreate()
    {
        return view('admin.about.ourmision-item-form');
    }

    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM STORE  (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourMisionItemStore(Request $request)
    {
        // dd($request->all());
        $request->validate([]);


        $imageName = '';
        $image = $request->file('image');
        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $imageName   = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


            if (!file_exists('assets/images/uploads/about/our-mision-item')) {
                mkdir('assets/images/uploads/our-mision-item', 0777, true);
            }
            $image->move(public_path('assets/images/uploads/our-mision-item'), $imageName);
        }

        AboutOurVisionItem::create(

            [
                'our_mision_id'             => 1,
                'title'                     => $request->title,
                'description'               => $request->short_description,
                'image'                     => $imageName
            ]
        );

        Toastr::success('Our Mision Item Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.about.ourMisionItem');
    }

    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM EDIT  (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourMisionItemEdit($id)
    {
        $data['ourMisionItem'] = AboutOurMisionItem::findOrFail($id);
        return view('admin.about.ourmision-item-form', $data);
    }
    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM UPDATE  (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourMisionItemUpdate(Request $request, $id)
    { {
            $ourMision = AboutOurMisionItem::find($id);
            $request->validate([]);
            $imageName = $ourMision->image;

            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $newImageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                if (!file_exists('assets/images/uploads/our-mision-item')) {
                    mkdir('assets/images/uploads/our-mision-item', 0777, true);
                }

                $image->move(public_path('assets/images/uploads/our-mision-item'), $newImageName);


                if ($imageName && file_exists(public_path('assets/images/uploads/our-mision-item/' . $imageName))) {
                    unlink(public_path('assets/images/uploads/our-mision-item/' . $imageName));
                }

                $imageName = $newImageName;
            }

            $ourMision->update([
                'our_mision_id'             => 1,
                'title'                     => $request->title,
                'description'               => $request->short_description,
                'image'                     => $imageName
            ]);
            Toastr::success('Our Mision Item Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('admin.our-team.index');
        }
    }
    /*
    |--------------------------------------------------------------------------
    | OUR MISION ITEM DELETE  (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourMisionItemDelete($id)
    {
        $ourMisionItem = AboutOurMisionItem::find($id);
        if ($ourMisionItem) {

            // dd($ourTeam->image);
            if ($ourMisionItem->image !== "") {
                $imagePath = public_path('assets/images/uploads/our-mision-item/' . $ourMisionItem->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            } else {
                $ourMisionItem->delete();
            }
            $ourMisionItem->delete();
            Toastr::success('Our Mision Item Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
