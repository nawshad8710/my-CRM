<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OurClientController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['ourClients'] = Client::get();
        return view('admin.our-client.index',  $data);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.our-client.form');
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


            if (!file_exists('assets/images/uploads/our-client')) {
                mkdir('assets/images/uploads/our-client', 0777, true);
            }
            $image->move(public_path('assets/images/uploads/our-client'), $imageName);
        }
        Client::create(

            [
                'title' => $request->title,
                'logo' => $imageName
            ]


        );
        Toastr::success('Our Client Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.our-client.index');
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT (METHOD)
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['ourClient'] =  Client::find($id);
        return view('admin.our-client.form', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([]);
        $ourClient = Client::findOrFail($id);

        $imageName = $ourClient->logo;

        $image = $request->file('image');
        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $newImageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/our-client')) {
                mkdir('assets/images/uploads/our-client', 0777, true);
            }

            $image->move(public_path('assets/images/uploads/our-client'), $newImageName);

            // Delete the previous icon file
            if ($imageName && file_exists(public_path('assets/images/uploads/our-client/' . $imageName))) {
                unlink(public_path('assets/images/uploads/our-client/' . $imageName));
            }

            $imageName = $newImageName; // Update the icon name
        }

        $ourClient->update([
            'title' => $request->title,
            'logo' => $imageName

        ]);
        Toastr::success('Our Client Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.our-client.index');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $ourClient = Client::find($id);
        if ($ourClient) {

            // dd($ourTeam->image);
            if ( $ourClient->logo !== "") {
                $imagePath = public_path('assets/images/uploads/our-client/' . $ourClient->logo);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            } else {
                $ourClient->delete();
            }
            $ourClient->delete();
            Toastr::success('Our Client Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
