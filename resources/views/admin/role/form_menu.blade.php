@extends('admin.layouts.app')

@section('title', 'Menu Form')

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
                                            <h3 class="text-center title-2">@isset($menu) Update @else Add @endisset Menu</h3>
                                        </div>
                                        <hr>
                                        <form action="@isset($menu){{ route('admin.role.menuUpdate', $menu->id) }}@else{{ route('admin.role.menuSubmit') }}@endisset" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="title" class="control-label mb-1">Title</label>
                                                        <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $menu->title ?? old('title') }}" required>
                                                        @error('title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="menu_head_id" class="control-label mb-1">Menu Head</label>
                                                        <select class="form-control" name="menu_head_id" id="menu_head_id" required>
                                                            <option value="">-- Select Menu Head --</option>
                                                            @foreach ($menu_heads as $key=> $menu_head)
                                                                <option value="{{ $menu_head->id }}" @isset($menu) {{ $menu->menu_head_id==$menu_head->id ? ' selected' : '' }} @endisset>{{ $menu_head->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('menu_head_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Status</label><br>
                                                        <label class="switch switch-3d switch-success mr-3">
                                                            <input type="checkbox" class="switch-input" name="status" 
                                                            @isset($menu)
                                                                @if($menu->status==1)
                                                                    checked="true"
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
                                                    <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" value="@isset($menu) Update @else Submit @endisset">
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