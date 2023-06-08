@extends('admin.layouts.app')

@section('title', 'Product Paln Form')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
<style>
    .switch.switch-3d .switch-label {
        background-color: #b4b1b1;
    }
    .note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable {
        margin-left: 10px;
    }
    input[type=checkbox], input[type=radio] {
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
                                            <h3 class="text-center title-2">@isset($product_plan) Update @else Add New @endisset Product Paln</h3>
                                        </div>
                                        <hr>
                                        <form action="@isset($product_plan){{ route('admin.sales.productplan.update', $product_plan->id) }}@else{{ route('admin.sales.productplan.submit') }}@endisset" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="title" class="control-label mb-1">Product</label>
                                                        <select class="form-control" name="product_id" id="status" required>
                                                            <option value="" >--Select product--</option>
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}"@isset($product_plan) {{ $product_plan->product_id==$product->id ? ' selected' : '' }} @endisset>{{ $product->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('product_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <label for="title" class="control-label mb-1">Plan Title</label>
                                                        <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $product_plan->title ?? old('title') }}" required>
                                                        @error('title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label for="price" class="control-label mb-1">Price</label>
                                                        <input id="price" name="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{ $product_plan->price ?? old('price') }}" required>
                                                        @error('price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="long_description" class="control-label mb-1">Description</label>
                                                <textarea name="description" id="long_description" rows="5" class="form-control @error('long_description') is-invalid @enderror">{{ $product_plan->long_description ?? old('long_description') }}</textarea>
                                                @error('long_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="discount_type" class="control-label mb-1">Discount Type</label>
                                                        <select class="form-control" name="discount_type" id="discount_type" required>
                                                            <option value="1"@isset($product_plan) {{ $product_plan->discount_type==1 ? ' selected' : '' }} @endisset>Flat</option>
                                                            <option value="2"@isset($product_plan) {{ $product_plan->discount_type==2 ? ' selected' : '' }} @endisset>Percentage</option>
                                                        </select>
                                                        @error('discount_type')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="discount_amount" class="control-label mb-1">Discount Amount</label>
                                                        <input id="discount_amount" name="discount_amount" type="text" class="form-control @error('discount_amount') is-invalid @enderror" value="{{ $product_plan->discount_amount ?? old('discount_amount') }}" required>
                                                        @error('discount_amount')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="title" class="control-label mb-1">Status</label>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="1"@isset($product_plan) {{ $product_plan->status==1 ? ' selected' : '' }} @endisset>Active</option>
                                                            <option value="0"@isset($product_plan) {{ $product_plan->status==0 ? ' selected' : '' }} @endisset>Inactive</option>
                                                        </select>
                                                        @error('status')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-9">

                                                </div>
                                                <div class="col-sm-3">
                                                    <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" value="@isset($product_plan) Update @else Submit @endisset">
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