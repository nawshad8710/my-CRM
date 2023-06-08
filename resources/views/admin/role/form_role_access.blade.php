@extends('admin.layouts.app')

@section('title', 'User Role Form')

@push('css')
<style>
    .switch.switch-3d .switch-label {
        background-color: #b4b1b1;
    }

    .card-title {
        font-size: 18px;
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
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                    </div>
                                    <div class="table-data__tool-right">
                                        @if(has_access('create_menu_head'))
                                        <button class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="modal" data-target="#menuHeadModal">
                                            <i class="zmdi zmdi-plus"></i>add menu head</button>
                                        @endif
                                        @if(has_access('create_menu'))
                                        <button class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="modal" data-target="#menuModal">
                                            <i class="zmdi zmdi-plus"></i>add menu</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Role: <span class="text-success">{{ $role->name }}</span></h3>
                                        </div>
                                        <hr>
                                        <form action="{{ route('admin.role.roleAccessUpdate', $role->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach ($menu_heads as $key => $menu_head)
                                                    <div class="col-sm-4 mt-4">
                                                        <div class="form-group">
                                                            <!-- <label class="switch switch-3d switch-success mr-3 xs" size="xs">
                                                                <input type="checkbox" class="switch-input" name="status" @if($menu_head->status==1) checked="true" @else checked="false" @endif value="1">
                                                                <span class="switch-label"></span>
                                                                <span class="switch-handle"></span>
                                                            </label> -->
                                                            <strong class="card-title">{{ $menu_head->title }}</strong>
                                                        </div>
                                                        <hr>
                                                        @foreach ($menu_head->menus as $menu_key => $menu)
                                                            @php
                                                                $i++;
                                                            @endphp
                                                            <div class="form-group">
                                                                <label class="switch switch-3d switch-success mr-3">
                                                                    <input type="checkbox" class="switch-input" onclick="checkStatus({{ $i }})" id="check{{ $i }}" @if(in_array($menu->key, $role_menus)) checked="true" @endif value="1">
                                                                    <span class="switch-label"></span>
                                                                    <span class="switch-handle"></span>
                                                                </label>
                                                                <input type="hidden" name="menu_status[]" id="status{{ $i }}" value="@if(in_array($menu->key, $role_menus)){{1}}@else{{0}}@endif">
                                                                <input type="hidden" name="menu_id[]" value="{{ $menu->id }}">
                                                                <input type="hidden" name="menu_key[]" value="{{ $menu->key }}">
                                                                <input type="hidden" name="menu_head_key[]" value="{{ $menu_head->key }}">
                                                                <span><mark>{{ $menu->title }}</mark></span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-9">

                                                </div>
                                                <div class="col-sm-3">
                                                    @if(has_access('role_wise_menu_permission_update'))
                                                    <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" value="@isset($role) Update @else Submit @endisset">
                                                    @endif
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
            
            <!-- modal add menu head -->
			<div class="modal fade" id="menuHeadModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
			 data-backdrop="static">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticModalLabel">Add New Menu Head</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
                        <form action="{{ route('admin.role.menuHeadSubmit') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">Title</label>
                                            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
					</div>
				</div>
			</div>
			<!-- end modal add menu head -->

            <!-- modal add menu -->
			<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
			 data-backdrop="static">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticModalLabel">Delete Role</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="{{ route('admin.role.menuSubmit') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="menu_head_id" class="control-label mb-1">Menu Head</label>
                                            <select class="form-control" name="menu_head_id" id="menu_head_id" required>
                                                <option value="">-- Select Menu Head --</option>
                                                @foreach ($menu_heads as $key=> $menu_head)
                                                    <option value="{{ $menu_head->id }}">{{ $menu_head->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('menu_head_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">Title</label>
                                            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
					</div>
				</div>
			</div>
			<!-- end modal add menu -->
@endsection

@push('js')
    <script>
        function checkStatus(no){
            //alert(no);
            var status = $('#status'+no).val();
            if(status==0){
                $('#status'+no).val(1);
            }else{
                $('#status'+no).val(0);
            }
        }
    </script>
@endpush