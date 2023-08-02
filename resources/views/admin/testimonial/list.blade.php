@extends('admin.layouts.app')

@section('title', 'Testimonial list')

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
                                <h3 class="title-5 m-b-35">Testimonial List</h3>
                                <div class="table-data__tool">
                                    {{-- <div class="table-data__tool-left">
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
                                    </div> --}}
                                    <div class="table-data__tool-right">

                                        <a href="{{ route('admin.testimonial.create') }}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Create Testimonial</a>

                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Short Description</th>
                                                <th>Long Description</th>
                                                <th>Image</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($testimonials) > 0)
                                                @foreach($testimonials as $key => $testimonial)
                                                <tr class="tr-shadow">
                                                    <td>{{ $testimonial->name }}</td>
                                                    <td>{{ $testimonial->designation }}</td>
                                                    <td class="desc">
                                                        <?php
                                                            $description =  strip_tags(html_entity_decode($testimonial->short_description));
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
                                                            <a href="#" class="desc-text" onclick="shortDescModalShow({{ $testimonial->id }})"> <u>View Details</u></a>
                                                        @else
                                                            {!! $testimonial->short_description !!}
                                                        @endif
                                                        <!-- {!! Str::limit($description, $limit = 30, $end = '. . .<a href="#" class="desc-text" onclick="descModalShow()">View Details</a>') !!} -->
                                                        <div id="short_description{{ $testimonial->id }}" class="d-none">
                                                            {!! $testimonial->short_description !!}
                                                        </div>
                                                    </td>
                                                    <td class="desc">
                                                        <?php
                                                            $description =  strip_tags(html_entity_decode($testimonial->long_description));
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
                                                            <a href="#" class="desc-text" onclick="longDescModalShow({{ $testimonial->id }})"> <u>View Details</u></a>
                                                        @else
                                                            {!! $testimonial->long_description !!}
                                                        @endif
                                                        <!-- {!! Str::limit($description, $limit = 30, $end = '. . .<a href="#" class="desc-text" onclick="descModalShow()">View Details</a>') !!} -->
                                                        <div id="long_description{{ $testimonial->id }}" class="d-none">
                                                            {!! $testimonial->long_description !!}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <img id="image" src="{{ asset('assets/images/uploads/testimonial/' . $testimonial->image) ?? asset('assets/images/defaultimage.png') }}" height="50px" width="50px" alt="your image" />
                                                    </td>
                                                    {{-- <td class="text-center">
                                                        @if($product->status == 0)
                                                            <!-- <span class="status--process">Active</span> -->
                                                            <span class="badge badge-secondary">Inactive</span>
                                                        @elseif($product->status == 1)
                                                            <span class="badge badge-primary">Active</span>
                                                        @endif
                                                    </td> --}}
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <a href="{{ route('admin.testimonial.edit', $testimonial->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </a>


                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteModalShow({{ $testimonial->id }})">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>

                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr class="tr-shadow">
                                                <td colspan="5" class="text-center">No Testimonial Found!</td>
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
							<h5 class="modal-title" id="staticModalLabel">Delete Product</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure? All plans related to this product will also be deleted.
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
							<div id="productDetailsWrapper">

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
        var description = $('#short_description'+id).html();
        //alert(description);
        $("#productDetailsWrapper").html(description);
        $("#scrollmodal").modal("show");
    }

    function longDescModalShow(id){
        this.event.preventDefault();
        var description = $('#long_description'+id).html();
        //alert(description);
        $("#productDetailsWrapper").html(description);
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
