<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use App\Models\Admin\Sale;
use App\Models\Admin\Product;
use App\Models\Admin\Branch;
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
    | SALE INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function renewableList()
    {
        $data['sales'] = Sale::where('has_renewable_item', 1)->get();
        // dd($data['sales']);
        return view('admin.sale.list_renewable', $data);
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
        $data['products'] = Product::where('status', 1)->get();
        $data['branches'] = Branch::where('status', 1)->get();

        return view('admin.sale.form', $data);
    }



    /*
    |--------------------------------------------------------------------------
    | SALE STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        //dd($request);
        $customer = Customer::where('id', $request->customer_id)->first();
        //$request->validate([]);
        if ($customer) {
            $hasRenewableItem = 0;
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

            $index = 0;
            foreach ($request->product_id as $productId) {
                if ($request->renewable[$index] == 1) {
                    $hasRenewableItem = 1;
                }
                $saleItem = $sale->saleItem()->create([
                    "product_id" => $productId,
                    "quantity" => $request->product_quantity[$index],
                    "price" => $request->product_price[$index],
                    "discount" => $request->product_price[$index],
                    "is_renewable" => $request->renewable[$index],
                    "next_renew_date" => $request->nextRenewDate[$index],
                    "is_customizable" => $request->customizable[$index],
                    "customize_description" => $request->customizeDescription[$index],
                    "customize_amount" => $request->customizeAmount[$index],
                    "total_price" => $request->product_total_price[$index],
                ]);

                $index++;
            }

            if ($hasRenewableItem == 1) {
                $sale->has_renewable_item = 1;
                $sale->save();
            }

            $data = [
                'sale' => $sale,
                'product_info' => $saleItem

            ];

            $pdf = PDF::loadView('frontend/sales/myPDF', $data);
            $pdf->download('nicesnippets.pdf');
            Toastr::success('Sales Create Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            //$pdf->download('nicesnippets.pdf');
            session()->put('list', []);
            return  redirect()->route('admin.sales.list');
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
    | SEND MESSAGE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function sendMessage($id)
    {
        $sale = Sale::findOrFail($id);

        Toastr::success('Message Sent Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return 1;
    }


    /*
    |--------------------------------------------------------------------------
    | SALE DETAIL (METHOD)
    |--------------------------------------------------------------------------
    */
    public function detail($id)
    {
        $data['sale'] = Sale::findOrFail($id);

        return view('admin.sale.detail', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | SALE DETAIL (METHOD)
    |--------------------------------------------------------------------------
    */
    public function downloadInvoice($id)
    {
        $sale = Sale::findOrFail($id);

        $data = [
            'sale' => $sale,
            'product_info' => $sale->saleItem()

        ];

        // $pdf = PDF::loadView('frontend/sales/myPDF', $data);
        $pdf = PDF::loadView('frontend/sales/newInvoice', $data);
        // $paper_size = array(0, 0, 595, 842);
        // $pdf->set_paper($paper_size);
        $pdf->set_paper("A4", "portrait");
        // $pdf->getDomPDF()->setPaper('A4', 'portrait');
        return $pdf->download('invoice.pdf');
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
