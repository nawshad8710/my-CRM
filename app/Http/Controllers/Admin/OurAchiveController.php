<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\OurAchieve;
use App\Models\Admin\OurAchieveItem;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OurAchiveController extends Controller
{
    public function form()
    {
        $data['ourAchive'] = OurAchieve::first();
        $data['ourAchiveItems'] = OurAchieveItem::paginate(3);
        return view('admin.our-achieve.index', $data);
    }


    public function storeAndUpdate(Request $request)
    {
        $request->validate([]);
        OurAchieve::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,
                'short_description' => $request->short_description
            ]
        );

        Toastr::success('Our Achive Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return back();
    }



    public function storeAchiveItem(Request $request)
    {
        // dd($request->all());
        $request->validate([]);
        $ourAchive = OurAchieve::first();
        if ($ourAchive) {
            $iconName = '';
            $icon = $request->file('icon');
            if ($icon) {
                $currentDate = Carbon::now()->toDateString();
                $iconName   = $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();


                if (!file_exists('assets/images/uploads/our-achive')) {
                    mkdir('assets/images/uploads/our-achive', 0777, true);
                }
                $icon->move(public_path('assets/images/uploads/our-achive'), $iconName);
            }
            OurAchieveItem::create([
                'our_achieve_id' => $ourAchive->id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'icon' => $iconName
            ]);

            Toastr::success('Our Achive Item Create Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.our-achive.form');
        }
    }


    public function editAchiveItem($id)
    {
        $achiveItem = OurAchieveItem::find($id);
        return json_decode($achiveItem);
    }



    public function updateAchiveItem(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([]);

        $ourAchiveItem = OurAchieveItem::findOrFail($id);

        $iconName = $ourAchiveItem->icon; // Get the current icon name

        $icon = $request->file('icon');
        if ($icon) {
            $currentDate = Carbon::now()->toDateString();
            $newIconName = $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/our-achive')) {
                mkdir('assets/images/uploads/our-achive', 0777, true);
            }

            $icon->move(public_path('assets/images/uploads/our-achive'), $newIconName);

            // Delete the previous icon file
            if ($iconName && file_exists(public_path('assets/images/uploads/our-achive/' . $iconName))) {
                unlink(public_path('assets/images/uploads/our-achive/' . $iconName));
            }

            $iconName = $newIconName; // Update the icon name
        }

        $ourAchiveItem->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'icon' => $iconName
        ]);

        Toastr::success('Our Achieve Item Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.our-achive.form');
    }




    public function deleteAchiveItem($id)
    {
        $ourAchive = OurAchieveItem::findOrFail($id);

        if ($ourAchive) {
            $iconPath = public_path($ourAchive->icon);
            if (file_exists($iconPath)) {
                unlink($iconPath);
            } else {
                $ourAchive->delete();
            }
            $ourAchive->delete();
            Toastr::success('Our Achive Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
