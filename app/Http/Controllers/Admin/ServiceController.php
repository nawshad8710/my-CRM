<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\OurService;
use App\Models\OurServiceItem;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['ourService'] = OurService::get();
        return view('admin.service.index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.service.form');
    }
    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([]);
        $iconName = '';
        $icon = $request->file('icon');
        if ($icon) {
            $currentDate = Carbon::now()->toDateString();
            $iconName   = $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();


            if (!file_exists('assets/images/uploads/our-service')) {
                mkdir('assets/images/uploads/our-service', 0777, true);
            }
            $icon->move(public_path('assets/images/uploads/our-service'), $iconName);
        }

        OurService::create(
            [
                'title' => $request->title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'icon' => $iconName,
            ]
        );
        Toastr::success('Our Service Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.service.index');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT (METHOD)
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $data['service'] = OurService::findOrFail($id);
        return view('admin.service.form', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $request->validate([]);
        $service = OurService::findOrFail($id);
        $iconName = $service->icon; // Get the current icon name

        $icon = $request->file('icon');
        if ($icon) {
            $currentDate = Carbon::now()->toDateString();
            $newIconName = $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/our-service')) {
                mkdir('assets/images/uploads/our-service', 0777, true);
            }

            $icon->move(public_path('assets/images/uploads/our-service'), $newIconName);

            // Delete the previous icon file
            if ($iconName && file_exists(public_path('assets/images/uploads/our-service/' . $iconName))) {
                unlink(public_path('assets/images/uploads/our-service/' . $iconName));
            }

            $iconName = $newIconName; // Update the icon name
        }
        $service->update([
            'title'                     => $request->title,
            'short_description'         => $request->short_description,
            'long_description'          => $request->long_description,
            'icon'                      =>  $iconName
        ]);
        Toastr::success('Our Service Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.service.index');

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $ourService = OurService::findOrFail($id);
        if ($ourService->icon) {
            $iconPath = public_path($ourService->icon);
            if (file_exists($iconPath)) {
                unlink($iconPath);
            } else {
                $ourService->delete();
            }
            $ourService->delete();
            Toastr::success('Our Serive Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
