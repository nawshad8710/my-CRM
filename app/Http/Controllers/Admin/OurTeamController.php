<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use App\Models\Admin\OurTeam;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OurTeamController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['ourTeam'] = OurTeam::first();
        return view('admin.our-team.index', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.our-team.form');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([]);


        $imageName = '';
        $image = $request->file('image');
        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $imageName   = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


            if (!file_exists('assets/images/uploads/our-team')) {
                mkdir('assets/images/uploads/our-team', 0777, true);
            }
            $image->move(public_path('assets/images/uploads/our-team'), $imageName);
        }

        OurTeam::create(

            [
                'name'          => $request->name,
                'designation'   => $request->designation,
                'field'         => $request->field,
                'image'         => $imageName
            ]
        );

        Toastr::success('Our Team Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.our-team.index');
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT (METHOD)
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $data['ourTeam'] = OurTeam::find($id);
        return view('admin.our-team.form', $data);
    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $ourTeam = OurTeam::find($id);
        $request->validate([]);
        $imageName = $ourTeam->image;

        $image = $request->file('image');
        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $newImageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/our-team')) {
                mkdir('assets/images/uploads/our-team', 0777, true);
            }

            $image->move(public_path('assets/images/uploads/our-team'), $newImageName);

            // Delete the previous icon file
            if ($imageName && file_exists(public_path('assets/images/uploads/our-team/' . $imageName))) {
                unlink(public_path('assets/images/uploads/our-team/' . $imageName));
            }

            $imageName = $newImageName; // Update the icon name
        }

        $ourTeam->update([
            'name'              => $request->name,
            'designation'       => $request->designation,
            'field'             => $request->field,
            'image'             => $imageName
        ]);
        Toastr::success('Our Team Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.our-team.index');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $ourTeam = OurTeam::find($id);
        if ($ourTeam->image) {
            $imagePath = public_path($ourTeam->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            } else {
                $ourTeam->delete();
            }
            $ourTeam->delete();
            Toastr::success('Our Team Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
