@extends('admin.layouts.app')

@section('title', 'Branch Form')

@push('css')
<style>
    .switch.switch-3d .switch-label {
        background-color: #b4b1b1;
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
                                            <h3 class="text-center title-2">@isset($branch) Update @else Add @endisset Branch</h3>
                                        </div>
                                        <hr>
                                        <form action="@isset($branch){{ route('admin.branch.update', $branch->id) }}@else{{ route('admin.branch.submit') }}@endisset" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label mb-1">Name</label>
                                                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $branch->name ?? old('name') }}" required>
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
                                                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $branch->email ?? old('email') }}" required>
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="phone" class="control-label mb-1">Phone</label>
                                                        <input id="phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ $branch->phone ?? old('phone') }}" required>
                                                        @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group has-success">
                                                <label for="address" class="control-label mb-1">Address</label>
                                                <textarea name="address" id="address" rows="5" class="form-control @error('address') is-invalid @enderror">{{ $branch->address ?? old('address') }}</textarea>
                                                @error('address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="photo" class="control-label mb-1">Profile Photo</label>
                                                    @isset($branch)
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <img src="{{ asset('assets/images/uploads/users') }}/{{ $branch->photo }}" alt="" width="50Px" height="50px">
                                                            </div>
                                                            <div class="col-10">
                                                                <input name="photo" type="file" class="form-control @error('photo') is-invalid @enderror">
                                                                @error('photo')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @else
                                                        <input name="photo" type="file" class="form-control @error('photo') is-invalid @enderror" required>
                                                        @error('photo')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror    
                                                    @endisset
                                                </div>
                                                
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="">Status</label><br>
                                                        <label class="switch switch-3d switch-success mr-3">
                                                            <input type="checkbox" class="switch-input" name="status" 
                                                            @isset($branch)
                                                                @if($branch->status==1)
                                                                    checked="false"
                                                                @endif
                                                            @else
                                                                checked="true"
                                                            @endisset
                                                              value="1">
                                                            <span class="switch-label"></span>
                                                            <span class="switch-handle"></span>
                                                        </label>
                                                        <span>Active</span>
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
                                                    <input type="submit" class="btn btn-lg btn-info mt-5 float-right" value="@isset($branch) Update @else Submit @endisset">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Company</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Company</label>
                                            <input type="text" id="company" placeholder="Enter your company name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">VAT</label>
                                            <input type="text" id="vat" placeholder="DE1234567890" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class=" form-control-label">Street</label>
                                            <input type="text" id="street" placeholder="Enter street name" class="form-control">
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="city" class=" form-control-label">City</label>
                                                    <input type="text" id="city" placeholder="Enter your city" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="postal-code" class=" form-control-label">Postal Code</label>
                                                    <input type="text" id="postal-code" placeholder="Postal Code" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="country" class=" form-control-label">Country</label>
                                            <input type="text" id="country" placeholder="Country name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
@endsection