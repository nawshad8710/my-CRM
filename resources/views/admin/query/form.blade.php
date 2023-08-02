@extends('admin.layouts.app')

@section('title', 'Query Form')

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
                                            <h3 class="text-center title-2">@isset($query) Update @else Add New @endisset Query</h3>
                                        </div>
                                        <hr>
                                        <form action="@isset($query){{ route('admin.sales.query.update', $query->id) }}@else{{ route('admin.sales.query.store') }}@endisset" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label mb-1">Customer Name</label>
                                                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $query->name ?? old('name') }}" required>
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="phone" class="control-label mb-1">Customer Phone</label>
                                                        <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ $query->phone ?? old('phone') }}" required>
                                                        @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email" class="control-label mb-1">Customer Email</label>
                                                        <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $query->email ?? old('email') }}">
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group has-success">
                                                        <label for="address" class="control-label mb-1">Customer Address</label>
                                                        <textarea name="address" id="address" rows="1" class="form-control @error('address') is-invalid @enderror">{{ $query->address ?? old('address') }}</textarea>
                                                        @error('address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                        
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="company_name" class="control-label mb-1">Company Name</label>
                                                        <input id="company_name" name="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" value="{{ $query->company_name ?? old('company_name') }}">
                                                        @error('company_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group has-success">
                                                        <label for="company_address" class="control-label mb-1">Company Address</label>
                                                        <textarea name="company_address" id="company_address" rows="1" class="form-control @error('company_address') is-invalid @enderror">{{ $query->company_address ?? old('company_address') }}</textarea>
                                                        @error('company_address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="description" class="control-label mb-1">Description</label>
                                                <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $query->description ?? old('description') }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-check mt-4">
                                                        <label for="is_quotation_requested" class="control-label mb-1"></label>
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="is_quotation_requested" id="flexCheckDefault"
                                                            @isset($query) {{ $query->is_quotation_requested == 1 ? ' checked' : '' }} @endisset>
                                                        <label class="form-check-label ml-2 mt-1" for="flexCheckDefault">
                                                            Quotation requested
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <label for="is_menu" class="control-label mb-1"></label>
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="is_proposal_requested" id="flexCheckDefault"
                                                            @isset($query) {{ $query->is_proposal_requested == 1 ? ' checked' : '' }} @endisset>
                                                        <label class="form-check-label ml-2 mt-1" for="flexCheckDefault">
                                                            Proposal requested
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-9">

                                                </div>
                                                <div class="col-sm-3">
                                                    <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" value="@isset($query) Update @else Submit @endisset">
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
        // $('#short_description').summernote();
        $('#description').summernote();
     });
</script>
@endpush
