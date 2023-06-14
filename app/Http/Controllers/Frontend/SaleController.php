<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $products = Product::where('title', 'like', '%' . $request->search . '%')->get();
        // return view('frontend.sales.index', compact('products'));
        return json_decode($products);
    }

    public function addtoList(Request $request)
    {
        $id = $request->id;
        $listProduct = Product::find($id);
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
            ];
        }

        session()->put('list', $list);

        return response()->json([
            'message' => 'Product added to list.',
            'listItem' => $list,
        ]);
    }



    public function listProduct()
    {
        $list = session()->get('list', []);

        // return view('frontend.sales.index', compact('list'));
        return response()->json([
            'message' => 'List products',
            'data' => $list,
        ]);
    }


}
