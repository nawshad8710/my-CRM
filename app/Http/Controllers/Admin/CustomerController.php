<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use App\Models\CustomerQuery;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER INDEX (METHOD)
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $data['customers'] = Customer::get();

        return view('admin.customer.list', $data);
    }
    /*
    |--------------------------------------------------------------------------
    | CUSTOMER QUERY LIST (METHOD)
    |--------------------------------------------------------------------------
    */

    public function customerQueryList()
    {

        $data['customers'] = CustomerQuery::get();

        return view('admin.customer.customer-query', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER CREATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.customer.form');
    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([]);
        Customer::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'address'           => $request->address,
            'status'            => $request->status
        ]);

        Toastr::success('Customer Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.customer.index');
    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER EDIT (METHOD)
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['customer'] = Customer::findOrFail($id);
        return view('admin/customer/form', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */


    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $request->validate([]);
        $customer->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'address'           => $request->address,
            'status'            => $request->status ?? 0
        ]);
        Toastr::success('Customer Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.customer.index');
    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER DELETE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        if ($customer) {
            $customer->delete();
            Toastr::success('Customer Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }
    /*
    |--------------------------------------------------------------------------
    | CUSTOMER QUERY DELETE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function customerQueryDelete($id)
    {
        $customer = CustomerQuery::findOrFail($id);
        if ($customer) {
            $customer->delete();
            Toastr::success('Customer Query Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }


    public function singleCustomerQuery($id)
    {
        $customerQuery = CustomerQuery::find($id);
        return json_decode($customerQuery);
    }
}
