<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\IndustryServe;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndustryServeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['industryServe'] = IndustryServe::get();
        return view('admin.industry-serve.index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.industry-serve.form');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([]);
        $iconName = '';
        $icon = $request->file('icon');
        if ($icon) {
            $currentDate = Carbon::now()->toDateString();
            $iconName   = $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();


            if (!file_exists('assets/images/uploads/industry-serve')) {
                mkdir('assets/images/uploads/industry-serve', 0777, true);
            }
            $icon->move(public_path('assets/images/uploads/industry-serve'), $iconName);
        }

        IndustryServe::create([

            'title' => $request->title,
            'icon' => $iconName
        ]);
        Toastr::success('Industry Serve Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.industry-serve.index');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT (METHOD)
    |--------------------------------------------------------------------------
    */


    public function edit($id)
    {
        $data['industryServe'] = IndustryServe::findOrFail($id);
        return view('admin.industry-serve.form', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([]);
        $industryServe = IndustryServe::findOrFail($id);
        $iconName = $industryServe->icon; // Get the current icon name

        $icon = $request->file('icon');
        if ($icon) {
            $currentDate = Carbon::now()->toDateString();
            $newIconName = $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/industry-serve')) {
                mkdir('assets/images/uploads/industry-serve', 0777, true);
            }

            $icon->move(public_path('assets/images/uploads/industry-serve'), $newIconName);

            // Delete the previous icon file
            if ($iconName && file_exists(public_path('assets/images/uploads/industry-serve/' . $iconName))) {
                unlink(public_path('assets/images/uploads/industry-serve/' . $iconName));
            }

            $iconName = $newIconName; // Update the icon name
        }
        $industryServe->update([
            'title'                     => $request->title,
            'icon'                      =>  $iconName
        ]);
        Toastr::success('Industry Serve Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.industry-serve.index');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $industryServe =  IndustryServe::find($id);
        if ($industryServe->icon) {
            $iconPath = public_path($industryServe->icon);
            if (file_exists($iconPath)) {
                unlink($iconPath);
            } else {
                $industryServe->delete();
            }
            $industryServe->delete();
            Toastr::success('Industry Serve Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
