@extends('admin.layouts.app')

@section('title', 'User Form')

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
                                            <h3 class="text-center title-2">@isset($user) Update @else Add @endisset User</h3>
                                        </div>
                                        <hr>
                                        <form action="@isset($user){{ route('admin.role.userUpdate', $user->id) }}@else{{ route('admin.role.userSubmit') }}@endisset" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label mb-1">Name</label>
                                                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name ?? old('name') }}" required>
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="username" class="control-label mb-1">Username</label>
                                                        <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username ?? old('username') }}" required>
                                                        @error('username')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email" class="control-label mb-1">Email</label>
                                                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email ?? old('email') }}" required>
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="phone" class="control-label mb-1">Phone</label>
                                                        <input id="phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone ?? old('phone') }}" required>
                                                        @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="designation" class="control-label mb-1">Designation</label>
                                                        <input id="designation" name="designation" type="text" class="form-control @error('designation') is-invalid @enderror" value="{{ $user->designation ?? old('designation') }}" required>
                                                        @error('designation')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="salary" class="control-label mb-1">Salary</label>
                                                        <input id="salary" name="salary" type="tel" class="form-control @error('salary') is-invalid @enderror" value="{{ $user->salary ?? old('salary') }}" required>
                                                        @error('salary')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="address" class="control-label mb-1">Address</label>
                                                <textarea name="address" id="address" rows="5" class="form-control @error('address') is-invalid @enderror">{{ $user->address ?? old('address') }}</textarea>
                                                @error('address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="photo" class="control-label mb-1">Profile Photo</label>
                                                    @isset($user)
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <img src="{{ asset('assets/images/uploads/users') }}/{{ $user->photo }}" alt="" width="50Px" height="50px">
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
                                                    <label for="role_id">Role</label>
                                                    <select name="role_id" id="role_id" class="form-control">
                                                        <option value="">--Select Role--</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}" @isset($user)
                                                                @if ($role->id == $user->role_id)
                                                                    selected
                                                                @endif
                                                            @endisset>{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="">Status</label><br>
                                                        <label class="switch switch-3d switch-success mr-3">
                                                            <input type="checkbox" class="switch-input" name="status" 
                                                            @isset($user)
                                                                @if($user->status==1)
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
                                                    <input type="submit" class="btn btn-lg btn-info mt-5 float-right" value="@isset($user) Update @else Submit @endisset">
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