@extends('admin.layouts.app')

@section('title', 'Sale Form')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
<style>
    .switch.switch-3d .switch-label {
        background-color: #b4b1b1;
    }

    .note-editor.note-airframe .note-editing-area .note-editable,
    .note-editor.note-frame .note-editing-area .note-editable {
        margin-left: 10px;
    }

    input[type=checkbox],
    input[type=radio] {
        height: 25px;
        width: 25px;
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
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">@isset($sale) Update @else Add New @endisset Sale</h3>
                            </div>
                            <hr>
                            <form
                                action="@isset($sale){{ route('admin.sales.update', $sale->id) }}@else{{ route('admin.sales.submit') }}@endisset"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="invoice_no" class="control-label mb-1">Invoice No.</label>
                                            <input id="invoice_no" name="invoice_no" type="text"
                                                class="form-control @error('invoice_no') is-invalid @enderror"
                                                value="{{ $sale->invoice_no ?? old('invoice_no') }}" required>
                                            @error('invoice_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="customer_id" class="control-label mb-1">Customer</label>
                                            <select class="form-control" name="customer_id" id="customer_id" required>
                                                <option value="">--Select Customer--</option>
                                                @foreach ($customers as $customer)
                                                @isset($sale)
                                                <option value="{{ $customer->id }}" {{ $sale->customer_id==$customer->id
                                                    ? ' selected' : '' }}>{{ $customer->name }}</option>
                                                @else
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>

                                                @endisset
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="user_id" class="control-label mb-1">User</label>
                                            <select class="form-control" name="user_id" id="user_id" required>
                                                <option value="">--Select User--</option>
                                                @foreach ($users as $user)
                                                @isset($sale)
                                                <option value="{{ $user->id }}" {{ $sale->user_id==$user->id
                                                    ? ' selected' : '' }}>{{ $user->name }}</option>
                                                @else
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>

                                                @endisset
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input id="name" name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ $sale->name ?? old('name') }}" required>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <input id="email" name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ $sale->email ?? old('email') }}" required>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Phone</label>
                                            <input id="phone" name="phone" type="text"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ $sale->phone ?? old('phone') }}" required>
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="price" class="control-label mb-1">Price</label>
                                            <input id="price" name="price" type="text"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ $sale->price ?? old('price') }}" required>
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="due_amount" class="control-label mb-1">Due Amount</label>
                                            <input id="due_amount" name="due_amount" type="text"
                                                class="form-control @error('due_amount') is-invalid @enderror"
                                                value="{{ $sale->due_amount ?? old('due_amount') }}" required>
                                            @error('due_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="paid_amount" class="control-label mb-1">Paid Amount</label>
                                            <input id="paid_amount" name="paid_amount" type="text"
                                                class="form-control @error('paid_amount') is-invalid @enderror"
                                                value="{{ $sale->paid_amount ?? old('paid_amount') }}" required>
                                            @error('paid_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="payment_method" class="control-label mb-1">Payment Method</label>
                                            <input id="payment_method" name="payment_method" type="text"
                                                class="form-control @error('payment_method') is-invalid @enderror"
                                                value="{{ $sale->payment_method ?? old('payment_method') }}" required>
                                            @error('payment_method')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="payment_status" class="control-label mb-1">Payment Status</label>
                                            <select class="form-control" name="payment_status" id="payment_status">
                                                <option value="0" @isset($sale) {{ $sale->payment_status==0 ? ' selected'
                                                    : '' }} @endisset>Pending</option>
                                                <option value="1" @isset($sale) {{ $sale->payment_status==1 ? ' selected'
                                                    : '' }} @endisset>Paid</option>
                                                <option value="2" @isset($sale) {{ $sale->payment_status==2 ? ' selected'
                                                    : '' }} @endisset>Partially Paid</option>
                                            </select>
                                            @error('payment_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-9">

                                    </div>
                                    <div class="col-sm-3">
                                        <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"
                                            value="@isset($product) Update @else Submit @endisset">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#short_description').summernote();
        $('#long_description').summernote();
     });
</script>
@endpush
