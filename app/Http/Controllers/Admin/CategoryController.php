<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!has_access('categories')){
            abort(404);
        }

        $categories = Category::latest()->get();
        if(isset($_GET['status'])){
            $categories = $categories->where('status', $_GET['status']);
        }
        return view('admin.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!has_access('categories')){
            abort(404);
        }

        return view('admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'short_description' => 'nullable|max:255',
            'long_description' => 'nullable',
            'status' => 'nullable',
        ]);

        if(!$request->status || $request->status == NULL){
            $request->status = 0;
        }else{
            $request->status = 1;
        }

        Category::create([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'status' => $request->status,
        ]);


        Toastr::success('Category Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.sales.category.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!has_access('categories')){
            abort(404);
        }

        $category = Category::findOrFail($id);
        if($category){
            return view('admin.category.form', compact('category'));
        }

        Toastr::error('Category not found', 'error', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'short_description' => 'nullable|max:255',
            'long_description' => 'nullable',
            'status' => 'nullable',
        ]);

        $category = Category::findOrFail($id);

        if($category){
            if(!$request->status || $request->status == NULL){
                $request->status = 0;
            }else{
                $request->status = 1;
            }

            $category->update([
                'name' => $request->name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'status' => $request->status,
            ]);

            Toastr::success('Category Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('admin.sales.category.list');
        }

        Toastr::error('Category not found', 'error', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!has_access('categories')){
            abort(404);
        }

        $category = Category::findOrFail($id);
        if($category){
            $category->delete();
            Toastr::success('Category Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
