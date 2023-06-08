@extends('admin.layouts.app')

@section('title', 'Product Plans')

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
        .desc-text {
            color: #ff8327;
            cursor: pointer;
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
                                <h3 class="title-5 m-b-35">Product Plan List</h3>
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
                                        <!-- <button class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>filters</button> -->
                                    </div>
                                    <div class="table-data__tool-right">
                                        @if(has_access('product_plans'))
                                        <a href="{{ route('admin.sales.productplan.add') }}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add product plan</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($product_plans) > 0)
                                                @foreach($product_plans as $key => $product_plan)
                                                <tr class="tr-shadow">
                                                    <td>{{ $product_plan->title }}</td>
                                                    <td>{{ $product_plan->product->title }}</td>
                                                    <td>{{ $product_plan->price }}</td>
                                                    <td>
                                                        @if ($product_plan->discount_amount > 0)
                                                            @php
                                                                $discount = 0;
                                                                if($product_plan->discount_type==1){
                                                                    $discount = $product_plan->discount_amount;
                                                                }else if ($product_plan->discount_type==2){
                                                                    $discount = $product_plan->price * $product_plan->discount_amount / 100;
                                                                }
                                                            @endphp
                                                            {{ $discount }}
                                                        @else
                                                            {{ $product_plan->discount_amount }}
                                                        @endif
                                                    </td>
                                                    <td class="desc">
                                                        <?php 
                                                            $description =  strip_tags(html_entity_decode($product_plan->description));
                                                            if (strlen($description) > 30) {

                                                                // truncate string
                                                                $stringCut = substr($description, 0, 30);
                                                                $endPoint = strrpos($stringCut, ' ');
                                                            
                                                                //if the string doesn't contain any space then it will cut without word basis.
                                                                $desc = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                                $desc .= '...';
                                                            }                                                            
                                                        ?>
                                                        @if (strlen($description) > 30)
                                                            {{ $desc }}
                                                            <a href="#" class="desc-text" onclick="shortDescModalShow({{ $product_plan->id }})"> <u>View Details</u></a>
                                                        @else
                                                            {!! $product_plan->description !!}
                                                        @endif
                                                        <!-- {!! Str::limit($description, $limit = 30, $end = '. . .<a href="#" class="desc-text" onclick="descModalShow()">View Details</a>') !!} -->
                                                        <div id="description{{ $product_plan->id }}" class="d-none">
                                                            {!! $product_plan->description !!}
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($product_plan->status == 0)
                                                            <!-- <span class="status--process">Active</span> -->
                                                            <span class="badge badge-secondary">Inactive</span>
                                                        @elseif($product_plan->status == 1)
                                                            <span class="badge badge-primary">Active</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            @if(has_access('product_plans'))
                                                            <a href="{{ route('admin.sales.productplan.edit', $product_plan->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </a>
                                                            @endif
                                                            @if(has_access('product_plans'))
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteModalShow({{ $product_plan->id }})">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr class="tr-shadow">
                                                <td colspan="7" class="text-center">No Product Plan Found!</td>
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
							<h5 class="modal-title" id="staticModalLabel">Delete Product Plan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure you want to delete this plan?
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

            <!-- modal description -->
			<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="scrollmodalLabel">Report Description</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="product_planDetailsWrapper">
								
                            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end modal description -->
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

    function shortDescModalShow(id){
        this.event.preventDefault();
        var description = $('#description'+id).html();
        //alert(description);
        $("#product_planDetailsWrapper").html(description);
        $("#scrollmodal").modal("show");
    }

    function longDescModalShow(id){
        this.event.preventDefault();
        var description = $('#long_description'+id).html();
        //alert(description);
        $("#product_planDetailsWrapper").html(description);
        $("#scrollmodal").modal("show");
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