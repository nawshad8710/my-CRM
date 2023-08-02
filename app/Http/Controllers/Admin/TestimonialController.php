<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Testimonial;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $data['testimonials'] = Testimonial::get();
        return view('admin.testimonial.list', $data);
    }

    public function create()
    {
        return view('admin.testimonial.form');
    }


    public function store(Request $request)
    {
        $request->validate([]);

        $imageName = '';
            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $imageName   = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


                if (!file_exists('assets/images/uploads/testimonial')) {
                    mkdir('assets/images/uploads/testimonial', 0777, true);
                }
                $image->move(public_path('assets/images/uploads/testimonial'), $imageName);
            }
        Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'short_description' => $request->short_description,
            'long_description' => $request->long_descripiton,
            'image' => $imageName
        ]);
        Toastr::success('Testimonial Create Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.testimonial.index');
    }



    public function edit($id)
    {
        $data['testimonial'] = Testimonial::findOrFail($id);
        return view('admin.testimonial.form', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([]);
        $testimonial = Testimonial::findOrFail($id);
        $imageName = $testimonial->image;

        $image = $request->file('image');
        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $newImageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/testimonial')) {
                mkdir('assets/images/uploads/testimonial', 0777, true);
            }

            $image->move(public_path('assets/images/uploads/testimonial'), $newImageName);

            // Delete the previous icon file
            if ($imageName && file_exists(public_path('assets/images/uploads/testimonial/' . $imageName))) {
                unlink(public_path('assets/images/uploads/testimonial/' . $imageName));
            }

            $imageName = $newImageName; // Update the icon name
        }
        $testimonial->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image' => $imageName,
        ]);
        Toastr::success('Testimonial updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.testimonial.index');
    }



    public function delete($id)
    {
        $testimonial = Testimonial::find($id);
        if ($testimonial) {
            $imagePath = public_path($testimonial->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            } else {
                $testimonial->delete();
            }
            $testimonial->delete();
            Toastr::success('Testimonial Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
