<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use App\Models\Admin\Sale;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SaleController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | SALE INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['sales'] = Sale::get();
        // dd($data['sales']);
        return view('admin.sale.list', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | SALE CREATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data['customers'] = Customer::get();
        $data['users'] = User::where('role_id', 1)
            ->where('status', 1)->get();

        return view('admin.sale.form', $data);
    }



    /*
    |--------------------------------------------------------------------------
    | SALE STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([]);

        Sale::create([
            'invoice_no' => $request->invoice_no,
            'customer_id' => $request->customer_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'price' => $request->price,
            'due_amount' => $request->due_amount,
            'paid_amount' => $request->paid_amount,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
        ]);
        Toastr::success('Sales Create Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.sales.list');
    }


    /*
    |--------------------------------------------------------------------------
    | SALE EDIT (METHOD)
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $data['sale'] = Sale::findOrFail($id);
        $data['customers'] = Customer::get();
        $data['users'] = User::where('role_id', 1)
            ->where('status', 1)->get();

        return view('admin.sale.form', $data);
    }



    /*
    |--------------------------------------------------------------------------
    | SALE UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $request->validate([]);
        $sale->update([
            'invoice_no' => $request->invoice_no,
            'customer_id' => $request->customer_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'price' => $request->price,
            'due_amount' => $request->due_amount,
            'paid_amount' => $request->paid_amount,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
        ]);
        Toastr::success('Sales Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.sales.list');
    }



    /*
    |--------------------------------------------------------------------------
    | SALE DELETE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        if ($sale) {
            $sale->delete();
            return 1;
        }
        return 0;
    }
}
