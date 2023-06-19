<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Sale;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;
class SaleController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Sale Index (METHOD)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $products = Product::query()
            ->when(request('search'), function ($q) {
                $q->where(function ($q) {
                    $q->where('title', 'like', '%' . request('search') . '%');
                });
            })
            ->get();
        // Session::flush();
        return view('frontend.sales.index', compact('products'));
    }


    /*
    |--------------------------------------------------------------------------
    | Product search (METHOD)
    |--------------------------------------------------------------------------
    */

    public function searchProduct(Request $request)
    {
        $products = Product::where('is_renewable',1)->where('title', 'like', '%' . $request->search . '%')->get();
        // return view('frontend.sales.index', compact('products'));
        return json_decode($products);
    }

    public function addtoList(Request $request)
    {
        $id = $request->id;
        $listProduct = Product::where('is_renewable',1)->find($id);
        $list = session()->get('list', []);
        if (isset($list[$id])) {
            $list[$id]['quantity']++;
            $list[$id]['price'] = $list[$id]['unit_price'] * $list[$id]['quantity'];
        } else {
            $list[$id] = [
                'id' => $listProduct->id,
                'name' => $listProduct->title,
                'unit_price' => $listProduct->price,
                'quantity' => 1,
                'price' => $listProduct->price,
                'renewable' => 0,
                'is_customization' => 0,
            ];
        }

        session()->put('list', $list);

        return response()->json([
            'message' => 'Product added to list.',
            'listItem' => $list,
        ]);
    }



    // public function updateList(Request $request)
    // {
    //     if($request->id && $request->quantity){
    //         $cart = session()->get('list');
    //         $cart[$request->id]["quantity"] = $request->quantity;
    //         session()->put('cart', $cart);
    //         session()->flash('success', 'Cart updated successfully');
    //     }
    // }



    public function listProduct()
    {
        $list = session()->get('list', []);

        // return view('frontend.sales.index', compact('list'));
        return response()->json([
            'message' => 'List products',
            'data' => $list,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | sale store (METHOD)
    |--------------------------------------------------------------------------
    */
    public function storeSale(Request $request)
    {
        // dd($request->all());
        $request->validate([]);
       $sale = Sale::create([
            'invoice_no' => 'default',
            'customer_id' => 1,
            'user_id' => 16,
            'name' => 'default',
            'email' => 'default@gmail.com',
            'phone' => 233553,
            'price' => $request->total,
            'due_amount' => $request->due,
            'paid_amount' => $request->paid,
            'payment_method' => $request->payment_method,
            // 'payment_status' => $request->payment_status,
        ]);

        $data = [
            'sale' => $sale,
        ];

        $pdf = PDF::loadView('frontend/sales/myPDF',$data);

        return $pdf->download('nicesnippets.pdf');
        // Toastr::success('Sales Create Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        // return back();
    }




    public function updateList(Request $request)
    {
        $id = $request->id;
        $action = $request->action;

        $list = session()->get('list', []);

        if (isset($list[$id])) {
            if ($action === 'decrease') {
                $list[$id]['quantity']--;
                if ($list[$id]['quantity'] <= 0) {
                    unset($list[$id]);
                } else {
                    $list[$id]['price'] = $list[$id]['unit_price'] * $list[$id]['quantity'];
                }
            } elseif ($action === 'increase') {
                $list[$id]['quantity']++;
                $list[$id]['price'] = $list[$id]['unit_price'] * $list[$id]['quantity'];
            }
        }

        session()->put('list', $list);

        return response()->json([
            'message' => 'Product quantity updated.',
            'listItem' => $list,
        ]);
    }




    public function deleteItem(Request $request)
    {
        $id = $request->id;
        $list = session()->get('list', []);

        if (isset($list[$id])) {
            unset($list[$id]);
            session()->put('list', $list);

            return response()->json([
                'message' => 'Item deleted successfully.',
                'listItem' => $list,
            ]);
        }

        return response()->json([
            'message' => 'Item not found.',
        ]);
    }


    public function updateListRenewable(Request $request){
        $id = $request->id;
        $action = $request->action;
        $list = session()->get('list', []);


        if (isset($list[$id])) {
            if ($action === 'true') {
                $list[$id]['renewable'] = 1;

            } elseif ($action === 'false') {
                $list[$id]['renewable'] = 0;

            }
        }

        session()->put('list', $list);
        return response()->json([
            'message' => 'Product Renewable updated.',
            'listItem' => $list,
        ]);
    }


    public function updateListUnitprice(Request $request)
    {
        $id = $request->id;
        $unitprice = $request->unit_price;

        $list = session()->get('list', []);

        if (isset($list[$id])) {

                $list[$id]['unit_price'] = $unitprice;
                $list[$id]['price'] = $list[$id]['unit_price'] * $list[$id]['quantity'];

        }

        session()->put('list', $list);

        return response()->json([
            'message' => 'Product Unit Price Updated.',
            'listItem' => $list,
        ]);
    }


    public function generateInvoicePDF()
    {
        $pdf = PDF::loadView('frontend/myPDF');

        return $pdf->download('nicesnippets.pdf');
    }
}
