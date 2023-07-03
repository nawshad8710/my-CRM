<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\WhyChooseUs;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['why_choose_us'] = WhyChooseUs::get();
        return view('admin.why-choose-us.list', $data);
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.why-choose-us.form');
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


            if (!file_exists('assets/images/uploads/why-choose-us')) {
                mkdir('assets/images/uploads/why-choose-us', 0777, true);
            }
            $icon->move(public_path('assets/images/uploads/why-choose-us'), $iconName);
        }

        WhyChooseUs::create([
            'title'                 => $request->input('title'),
            'short_description'     => $request->input('short_description'),
            'long_description'      => $request->input('long_description'),
            'icon'                  => $iconName
        ]);

        Toastr::success('Why Choose Us Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.why-choose-us.index');
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT (METHOD)
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['whyChooseUs'] = WhyChooseUs::findOrFail($id);
        return view('admin.why-choose-us.form', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([]);
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        $iconName = $whyChooseUs->icon;

        $icon = $request->file('icon');
        if ($icon) {
            $currentDate = Carbon::now()->toDateString();
            $newIconName = $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/why-choose-us')) {
                mkdir('assets/images/uploads/why-choose-us', 0777, true);
            }

            $icon->move(public_path('assets/images/uploads/why-choose-us'), $newIconName);


            if ($iconName && file_exists(public_path('assets/images/uploads/why-choose-us/' . $iconName))) {
                unlink(public_path('assets/images/uploads/why-choose-us/' . $iconName));
            }

            $iconName = $newIconName;
        }


        $whyChooseUs->update([
            'title'             => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'long_description'  => $request->input('long_description'),
            'icon'              =>$iconName,
        ]);
        Toastr::success('Why Choose Us Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.why-choose-us.index');
    }
}
