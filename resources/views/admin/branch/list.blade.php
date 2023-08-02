@extends('admin.layouts.app')

@section('title', 'Employees')

@push('css')
    <style>
        .photo .table-data-feature .item {
            height: 50px;
            width: 50px;
        }
        img {
            max-width: 50px;
        }
        .table-data2.table tbody td {
            padding: 0.75rem;
        }
    </style>
@endpush

@section('content')
<!-- MAIN CONTENT-->
        <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Brnach List</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="status" id="status">
                                                <option selected="selected" value="">Status</option>
                                                <option value="1" @isset($_GET['status']) @if($_GET['status']==1) selected @endif @endisset)>Active</option>
                                                <option value="0" @isset($_GET['status']) @if($_GET['status']==0) selected @endif @endisset)>Inactive</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        
                                    </div>
                                    <div class="table-data__tool-right">
                                        @if(has_access('create_branch'))
                                        <a href="{{ route('admin.branch.add') }}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add branch</a>
                                        @endif
                                            
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($branches) > 0)
                                                @foreach($branches as $key => $branch)
                                                <tr class="tr-shadow">
                                                    <td class="photo">
                                                        <div class="table-data-feature">
                                                            <img class="item" src="{{ asset('assets/images/uploads/users') }}/{{ $branch->photo }}" alt="{{ $branch->name }} image">
                                                        </div>
                                                    </td>
                                                    <td>{{ $branch->name }}</td>
                                                    <td>{{ $branch->phone }}</td>
                                                    <td>
                                                        <span class="block-email">{{ $branch->email }}</span>
                                                    </td>
                                                    <td class="desc">{{ $branch->address }}</td>
                                                    <td>
                                                        @if($branch->status == 1)
                                                            <!-- <span class="status--process">Active</span> -->
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            
                                                            @if(has_access('update_branch'))
                                                            <a href="{{ route('admin.branch.edit', $branch->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </a>
                                                            @endif
                                                            @if(has_access('delete_branch'))
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteModalShow({{ $branch->id }})">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                            @endif
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr class="tr-shadow">
                                                <td colspan="8" class="text-center">No Brnach Found!</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal static -->
			<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
			 data-backdrop="static">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticModalLabel">Delete Brnach</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure?
							</p>
                            <input type="hidden" id="deleteDataId" value="">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteData()">Confirm</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end modal static -->
@endsection

@push('js')
<script>
    function deleteModalShow(id){
        $('#deleteDataId').val(id);
        $("#staticModal").modal("show");
    }

    function deleteData(){
        $("#staticModal").modal("hide");
        var id = $('#deleteDataId').val();
        var url = "delete/"+id;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            success: function (response) {
                location.reload();
            },
            error: function(xhr) {
               console.log(xhr.statusText);
            }
        });
    }

    $("#status").change(function() {
        var status = $("#status").val();
        if(status){
            var url = window.location.origin + window.location.pathname + "?filter=1&status=" + status;
            location = url;
        }else{
            var url = window.location.origin + window.location.pathname;
            location = url;
        }

    });   
</script>
@endpush