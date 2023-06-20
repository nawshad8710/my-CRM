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
    public function index()
    {
        $data['ourService'] = OurService::first();
        return view('admin.service.index', $data);
    }


    public function createOrUpdate(Request $request)
    {
        $request->validate([]);
        OurService::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,
                'short_description' => $request->short_description
            ]
        );
    }



    public function serviceItemList()
    {
        $data['ourServiceItem'] = OurServiceItem::get();
        return view('admin.service.item-list', $data);
    }


    public function serviceItemCreate()
    {
        return view('admin.service.item-form');
    }


    public function serviceItemStore(Request $request)
    {
        $request->validate([]);

        $ourService = OurService::first();
        if ($ourService) {


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

            OurServiceItem::create([
                'our_service_id' =>$ourService->id,
                'title' =>$request->title,
                'short_description' =>$request->short_description,
                'long_description' =>$request->long_description,
                'icon' => $iconName
            ]);

            Toastr::success('Our Service Item Create Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.service.serviceItemList');
        }
    }


    public function serviceItemEdit($id)
    {
        $data['ourServiceItem'] = OurServiceItem::findOrFail($id);
        return view('admin.service.item-form', $data);
    }


    public function serviceItemUpdate(Request $request, $id)
    {
        $request->validate([]);

        $ourService = OurService::first();
        $ourServiceItem = OurServiceItem::findOrFail($id);

        $iconName = $ourServiceItem->icon;

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

        $ourServiceItem->update([
            'our_service_id' =>$ourService->id,
            'title' =>$request->title,
            'short_description' =>$request->short_description,
            'long_description' =>$request->long_description,
            'icon' => $iconName
        ]);

        Toastr::success('Our Service Item Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.service.serviceItemList');
    }


    public function serviceItemDelete($id)
    {
        $ourServiceItem = OurServiceItem::findOrFail($id);

        if ($ourServiceItem) {
            $iconPath = public_path($ourServiceItem->icon);
            if (file_exists($iconPath)) {
                unlink($iconPath);
            } else {
                $ourServiceItem->delete();
            }
            $ourServiceItem->delete();
            Toastr::success('Our Service Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
