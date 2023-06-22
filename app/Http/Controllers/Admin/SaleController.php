<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use App\Models\Admin\Sale;
use App\Models\User;
use PDF;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

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
        $customer = Customer::where('id', $request->customer_id)->first();
        $request->validate([]);
        if ($customer) {
            $sale = Sale::where('customer_id', $customer->id)->get();
            if ($sale->count() > 0) {
                Toastr::warning('Sale Already Create For This Customer', 'warning', ["positionClass" => "toast-top-right"]);
                return back();
            } else {
                $sale = Sale::create([
                    'invoice_no' =>  Str::random(8),
                    'customer_id' => $request->customer_id,
                    'user_id' => Auth()->id(),
                    'name' => optional($customer)->name,
                    'email' => optional($customer)->email,
                    'phone' => optional($customer)->phone,
                    'price' => $request->total,
                    'vat' => $request->vat,
                    'due_amount' => $request->due,
                    'paid_amount' => $request->paid,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_status,
                ]);

                foreach ($request->product_id as $index => $productId) {
                    $saleItem = $sale->saleItem()->create([
                        "product_id" => $productId,
                        "quantity" => $request->product_quantity[$index],
                        "price" => $request->product_price[$index],
                        "is_renewable" => $request->renewable[$index],
                        "is_customizable" => $request->customizable[$index],
                        "customize_description" => $request->customizeDescription[$index],
                        "customize_amount" => $request->customizeAmount[$index],
                        "total_price" => $request->product_total_price[$index],
                    ]);
                }

                $data = [
                    'sale' => $sale,
                    'product_info' => $saleItem

                ];

                $pdf = PDF::loadView('frontend/sales/myPDF', $data);
                $pdf->download('nicesnippets.pdf');
                Toastr::success('Sales Create Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return  $pdf->download('nicesnippets.pdf');
            }
        }
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
