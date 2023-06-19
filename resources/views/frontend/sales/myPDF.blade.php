<!DOCTYPE html>
<html>

<head>
    <title>invoice</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 45px;
        height: 45px;
        padding-top: 30px;
    }

    .logo span {
        margin-left: 8px;
        top: 19px;
        position: absolute;
        font-weight: bold;
        font-size: 25px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0">Invoice</h1>
        {{-- {{$sale->price}} --}}
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">{{$sale->invoice_no}}</span></p>

            <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color">{{ date('d-m-Y H:i a',
                    strtotime($sale->created_at)) }}</span></p>
        </div>

        <div style="clear: both;"></div>
    </div>
    {{-- <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50">From</th>
                <th class="w-50">To</th>
            </tr>
            <tr>
                <td>
                    <div class="box-text">
                        <p>{{$sale->user->name}}</p>

                    </div>
                </td>
                <td>
                    <div class="box-text">
                        <p>{{$sale->customer->name}}</p>
                        <p>{{$sale->customer->email}}</p>
                        <p>{{$sale->customer->phone}}</p>
                        <p>{{$sale->customer->address}}</p>

                    </div>
                </td>
            </tr>
        </table>
    </div> --}}
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50">Payment Method</th>
                {{-- <th class="w-50">Shipping Method</th> --}}
            </tr>
            <tr>
                <td>{{$sale->payment_method}}</td>
                {{-- <td>Free Shipping - Free Shipping</td> --}}
            </tr>
        </table>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50">SKU</th>
                <th class="w-50">Product Name</th>
                <th class="w-50">Price</th>
                <th class="w-50">Qty</th>
                <th class="w-50">Subtotal</th>

            </tr>
            {{-- @dd($product_info) --}}
            @foreach ($sale->saleItem as $key=>$products)
            <tr align="center">
                <td>{{$key+1}}</td>

                <td>

                    {{$products->product->title}}
                </td>
                <td>{{$products->price}}</td>
                <td>{{$products->quantity}}</td>
                <td>{{$products->total_price}}</td>

            </tr>
            @endforeach


            <tr>
                <td colspan="7">
                    <div class="total-part">
                        <div class="total-left w-85 float-left" align="right">
                            {{-- <p>Vat (18%)</p> --}}
                            <p>Paid</p>
                            <p>Due</p>
                            <p>Total</p>
                            <p>Payment Status</p>
                            {{-- <p>Total Payable</p> --}}
                        </div>
                        <div class="total-right w-15 float-left text-bold" align="right">
                            <p>{{$sale->paid_amount}}</p>
                            <p>{{$sale->due_amount}}</p>
                            <p>{{$sale->price}}</p>
                            <p>
                                @if($sale->payment_status == 0)
                                <p>pending</p>
                                @elseif ($sale->payment_status == 1)
                                <p>Paid</p>
                                @elseif($sale->payment_status == 2)
                                <p>Partial Paid</p>
                                @endif
                            </p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</html>
