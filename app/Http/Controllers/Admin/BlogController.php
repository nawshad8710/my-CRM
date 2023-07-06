<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['blogs'] = Blog::get();
        return view('admin.blog.list', $data);
    }
    /*
    |--------------------------------------------------------------------------
    | CREATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.blog.form');
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


            if (!file_exists('assets/images/uploads/blog')) {
                mkdir('assets/images/uploads/blog', 0777, true);
            }
            $image->move(public_path('assets/images/uploads/blog'), $imageName);
        }

        Blog::create([
            'title'                 => $request->input('title'),
            'short_description'     => $request->input('short_description'),
            'description'           => $request->input('description'),
            'image'                 => $imageName,
        ]);
        Toastr::success('Blogs Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.blog.index');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT (METHOD)
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['blog'] = Blog::findOrFail($id);
        return view('admin.blog.form', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $request->validate([]);
        $imageName = $blog->image;

        $image = $request->file('image');
        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $newImageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/blog')) {
                mkdir('assets/images/uploads/blog', 0777, true);
            }

            $image->move(public_path('assets/images/uploads/blog'), $newImageName);


            if ($imageName && file_exists(public_path('assets/images/uploads/blog/' . $imageName))) {
                unlink(public_path('assets/images/uploads/blog/' . $imageName));
            }

            $imageName = $newImageName;
        }

        $blog->update([
            'title'                 => $request->input('title'),
            'short_description'     => $request->input('short_description'),
            'description'           => $request->input('description'),
            'image'                 => $imageName,
        ]);
        Toastr::success('Blog Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.blog.index');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $blog = Blog::find($id);
        if ($blog) {

            // dd($ourTeam->image);
            if ( $blog->image !== "") {
                $imagePath = public_path('assets/images/uploads/blog/' . $blog->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            } else {
                $blog->delete();
            }
            $blog->delete();
            Toastr::success('Blog Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
