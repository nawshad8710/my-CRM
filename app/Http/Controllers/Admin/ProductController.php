<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!has_access('products')){
            abort(404);
        }

        $categories = Category::where('status', 1)->latest()->get();

        return view('admin.product.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            'title' => 'required|max:100',
            'short_description' => 'nullable|max:255',
            'long_description' => 'nullable',
            'category_id' => 'required',
            'status' => 'nullable',
        ]);

        if(!$request->status || $request->status == NULL){
            $request->status = 0;
        }else{
            $request->status = 1;
        }

        if(!$request->is_renewable || $request->is_renewable == NULL){
            $request->is_renewable = 0;
        }else{
            $request->is_renewable = 1;
        }

        Product::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'is_renewable' => $request->is_renewable,
        ]);

        Toastr::success('Product Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.sales.product.list');
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
        if(!has_access('products')){
            abort(404);
        }

        $product = Product::findOrFail($id);
        if($product){
            $categories = Category::where('status', 1)->latest()->get();
            return view('admin.product.form', compact('product', 'categories'));
        }

        Toastr::error('Product not found', 'error', ["positionClass" => "toast-top-right"]);
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
            'title' => 'required|max:100',
            'short_description' => 'nullable|max:255',
            'long_description' => 'nullable',
            'category_id' => 'required',
            'status' => 'nullable',
        ]);

        if(!$request->status || $request->status == NULL){
            $request->status = 0;
        }else{
            $request->status = 1;
        }

        if(!$request->is_renewable || $request->is_renewable == NULL){
            $request->is_renewable = 0;
        }else{
            $request->is_renewable = 1;
        }

        $product = Product::findOrFail($id);

        if($product){
            $product->update([
                'title' => $request->title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'status' => $request->status,
                'category_id' => $request->category_id,
                'is_renewable' => $request->is_renewable,
            ]);

            Toastr::success('Product Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('admin.sales.product.list');
        }

        Toastr::error('Product not found', 'error', ["positionClass" => "toast-top-right"]);
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
        if(!has_access('products')){
            abort(404);
        }

        $product = Product::findOrFail($id);
        if($product){
            $product->delete();
            Toastr::success('Product Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}