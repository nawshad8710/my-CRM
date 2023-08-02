<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style type="text/css">
    * {
        margin: 0%
    }

    body {
        font-family: 'Roboto Condensed', sans-serif;
        height: 100%;
        padding: 0%;
        margin: 0;
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



    table.table__body{

    }

    table.table__body thead {
        background: #4472C4;
        color: #fff;
        border: none;
        text-transform: uppercase;
    }

    table.table__body tbody tr th {
        background: #4472C4;
        color: #fff;
        font-size: 20px;
    }

    table.table__body tbody tr td {
        text-align: center;
        font-weight: 700;
        font-size: 16px;
        color: #000;
    }

    table.table__body tbody tr td {
        background: #B4C6E7;
    }

    .customer__info {

    }

    .customer__info .table__body {
        width: 100%;
        margin-top: 10px;
        padding: 0 10px 0 10px
    }

    table.table__body__content tbody {
        background: #4472C4;
        color: #fff;
        font-weight: 700;
    }

    table.table__body__content tbody tr td {
        border: 0;
        border-top: 1px solid #fff;
        font-size: 16px;
    }

    table.table__body__content {
        display: flex;
        justify-content: end;
        margin-top: 20px;
        padding: 10px 0px 10px 0px
    }
</style>

<body style="position: relative;">

    <div style="background: #fff">
        <div>
            {{-- <img src="assets/images/invoice__top.png'" alt=""> --}}
            <img style="width:100%; " src="{{ public_path('assets/images/invoice__top.png') }}">
        </div>
        <h1 style="text-align: center;background:#0F75BC;color:#fff;padding:10px 0;font-size:40px; margin-top: 50px">
            Invoice</h1>

        <div class="customer__info">

            <table class="table__body" style="margin-left: 0px">
                <thead>
                    <th>SL.</th>
                    <th>Item Name</th>
                    {{-- <th>Description</th> --}}
                    {{-- <th>Validity</th> --}}
                    <th>Quantity</th>
                    <th>Customize Amount</th>
                    <th>Customize Description</th>
                    {{-- <th>Unit Price</th> --}}
                    {{-- <th>Discount Amount</th> --}}
                    <th>Total Price</th>
                </thead>
                <tbody>
                    @foreach ($sale->saleItem as $key => $products)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td style="background-color: #4472C4; color:white">{{ $products->product->title }}</td>
                            <td>{{$products->quantity}}</td>
                            <td>{{$products->customize_amount}}</td>
                            <td>{{$products->customize_description}}</td>
                            <td>{{$products->total_price}}</td>
                        </tr>
                    @endforeach


                </tbody>
                </table>


                <div style="margin-top: 20px">
                    <div style="float: right; padding: 0 10px 0 10px">

                           <table style="border-collapse: collapse; border: none; background-color: #4472C4; color:white">
                            <tr style=" border: 0;">
                                <td>Paid</td>
                                <td>{{$sale->paid_amount}}</td>
                            </tr>
                            <tr>
                                <td>Due</td>
                                <td>{{$sale->due_amount}}</td>
                            </tr>
                            <tr>
                                <td>Payment Status</td>
                                <td>
                                    @if($sale->payment_status == 0)
                                    <p>pending</p>
                                    @elseif ($sale->payment_status == 1)
                                    <p>Paid</p>
                                    @elseif($sale->payment_status == 2)
                                    <p>Partial Paid</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>vat (%)</td>
                                <td>{{$sale->vat}}</td>
                            </tr>
                            <tr>
                                <td>
                                    Total
                                </td>
                                <td>
                                    {{$sale->price}}
                                </td>
                            </tr>
                           </table>

                    </div>

                </div>
            {{-- <table class="table__body__content">
                <tbody>
                    <tr>
                        <td><span>Subtotal Unit Price</span>: <span>32,000</span></td>
                    </tr>
                    <tr>
                        <td><span>Vat 5%</span>: <span>1,600</span></td>
                    </tr>
                    <tr>
                        <td><span>Total</span> <span>32,000</span></td>
                    </tr>
                    <tr>
                        <td><span>Advance</span>: <span>32,000</span></td>
                    </tr>
                    <tr>
                        <td><span>Due</span>: <span>32,000</span></td>
                    </tr>
                </tbody>
            </table>
            <table class="table__footer">
                <th> <span>Hosting Yearly Charge</span> <span>10,000 Taka</span></th>
            </table> --}}

        </div>



        {{-- <img src="{{ asset('assets/images/invoice__bottom.png') }}" alt=""> --}}
        <img style="width: 100%; position: absolute; bottom: 0"
            src="{{ public_path('assets/images/invoice__bottom.png') }}" alt="">


    </div>

</body>

</html>
