@extends('admin.layouts.app')

@section('title', 'Service Form')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
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

    table.table__footer {
        width: 100%;
        padding: 30px 0;
        padding-bottom: 200px;
    }

    table.table__footer tbody tr th {
        background: #0F75BC;
        color: #fff;
        font-weight: 700;
        border: none;
        font-size: 20px;
        display: flex;
        justify-content: space-between;
    }

    table.table__body thead tr th {
        background: #4472C4;
        color: #fff;
        border: none;
        padding: 15px 20px;
        font-size: 20px;
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
        width: 100%;
        padding: 10px;
    }

    .customer__info .table__body {
        width: 100%;
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
    }
</style>
@endpush

@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <div style="background: #fff">
                        <div>
                            <img src="{{ asset('assets/images/invoice__top.png') }}" alt="">
                        </div>
                        <h1 style="text-align: center;background:#0F75BC;color:#fff;padding:10px 0;font-size:40px">
                            Invoice</h1>

                        <div class="customer__info">

                            <table class="table__body">
                                <thead>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Validity</th>
                                    <th>Unit Price</th>
                                    <th>Discount</th>
                                    <th>Price</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Website</th>
                                        <td>E-Commerce</td>
                                        <td>Lifetime</td>
                                        <td>32,000</td>
                                        <td>0</td>
                                        <td>32,000</td>
                                    </tr>
                                    <tr>
                                        <th>Hosting</th>
                                        <td>10GB (Shared Hosting)</td>
                                        <td>1 Year</td>
                                        <td>10,000</td>
                                        <td>10,000</td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table__body__content">
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
                            </table>

                        </div>


                        <div>
                            <img src="{{ asset('assets/images/invoice__bottom.png') }}" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <a href="{{ route('admin.sales.download', $sale->id) }}" class="item" data-toggle="tooltip" data-placement="top"
            title="View" style="border: 1px solid blue; float: right; padding: 5px; margin: 10px;">
            Download Invoice <i class="zmdi zmdi-download"></i>
        </a>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        // $('#short_description').summernote();
        $('#long_description').summernote();
     });
</script>
@endpush

