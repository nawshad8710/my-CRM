<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\ProductPlan;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProductPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_plans = ProductPlan::latest()->get();

        return view('admin.product_plan.list', compact('product_plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!has_access('product_plans')){
            abort(404);
        }

        $products = Product::where('status', 1)->latest()->get();

        return view('admin.product_plan.form', compact('products'));
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
            'description' => 'nullable|max:255',
            'price' => 'required',
            'discount_type' => 'required',
            'discount_amount' => 'required',
            'product_id' => 'required',
            'status' => 'nullable',
        ]);

        if(!$request->status || $request->status == NULL){
            $request->status = 0;
        }else{
            $request->status = 1;
        }

        ProductPlan::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'status' => $request->status,
            'product_id' => $request->product_id,
        ]);

        Toastr::success('Product Plan Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.sales.productplan.list');
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
        if(!has_access('product_plans')){
            abort(404);
        }

        $product_plan = ProductPlan::findOrFail($id);
        if($product_plan){
            $products = Product::where('status', 1)->latest()->get();
            return view('admin.product_plan.form', compact('product_plan', 'products'));
        }

        Toastr::error('Product Plan not found', 'error', ["positionClass" => "toast-top-right"]);
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
            'description' => 'nullable|max:255',
            'price' => 'required',
            'discount_type' => 'required',
            'discount_amount' => 'required',
            'product_id' => 'required',
            'status' => 'nullable',
        ]);

        if(!$request->status || $request->status == NULL){
            $request->status = 0;
        }else{
            $request->status = 1;
        }

        $product_plan = ProductPlan::findOrFail($id);
        if($product_plan){
            $product_plan->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'discount_type' => $request->discount_type,
                'discount_amount' => $request->discount_amount,
                'status' => $request->status,
                'product_id' => $request->product_id,
            ]);

            Toastr::success('Product Plan Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('admin.sales.productplan.list');
        }

        Toastr::error('Product Plan not found', 'error', ["positionClass" => "toast-top-right"]);
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
        if(!has_access('product_plans')){
            abort(404);
        }

        $product_plan = ProductPlan::findOrFail($id);
        if($product_plan){
            $product_plan->delete();
            Toastr::success('Product Plan Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
}
