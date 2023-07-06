<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Technology;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['technologies'] = Technology::with('category')->get();
        return view('admin.technology.list', $data);
    }
    /*
    |--------------------------------------------------------------------------
    | CREATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data['categories'] = Category::get();
        return view('admin.technology.form', $data);
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


            if (!file_exists('assets/images/uploads/technology')) {
                mkdir('assets/images/uploads/technology', 0777, true);
            }
            $image->move(public_path('assets/images/uploads/technology'), $imageName);
        }

        Technology::create([
            'title'                 => $request->input('title'),
            'category_id'           => $request->category_id,
            'icon'                 => $imageName,
        ]);
        Toastr::success('Technology Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.technology.index');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT (METHOD)
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['technology'] = Technology::findOrFail($id);
        $data['categories'] = Category::get();
        return view('admin.technology.form', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $technology = Technology::find($id);
        $request->validate([]);
        $imageName = $technology->icon;

        $image = $request->file('image');
        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $newImageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/technology')) {
                mkdir('assets/images/uploads/technology', 0777, true);
            }

            $image->move(public_path('assets/images/uploads/technology'), $newImageName);


            if ($imageName && file_exists(public_path('assets/images/uploads/technology/' . $imageName))) {
                unlink(public_path('assets/images/uploads/technology/' . $imageName));
            }

            $imageName = $newImageName;
        }

        $technology->update([
            'title'                 => $request->input('title'),
            'category_id'           => $request->category_id,
            'icon'                 => $imageName,
        ]);
        Toastr::success('Technology Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.technology.index');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $technology = Technology::find($id);
        if ($technology) {

            // dd($ourTeam->image);
            if ( $technology->icon !== "") {
                $imagePath = public_path('assets/images/uploads/technology/' . $technology->icon);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            } else {
                $technology->delete();
            }
            $technology->delete();
            Toastr::success('Technology Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
