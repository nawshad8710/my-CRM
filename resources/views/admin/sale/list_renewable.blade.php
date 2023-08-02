@extends('admin.layouts.app')

@section('title', 'Renewable Sales')

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
                                <h3 class="title-5 m-b-35">Sale List</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        {{-- <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="status" id="status">
                                                <option selected="selected" value="">Status</option>
                                                <option value="1" @isset($_GET['status']) @if($_GET['status']==1) selected @endif @endisset)>Active</option>
                                                <option value="0" @isset($_GET['status']) @if($_GET['status']==0) selected @endif @endisset)>Inactive</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div> --}}
                                        <!-- <button class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>filters</button> -->
                                    </div>
                                    <div class="table-data__tool-right">
                                        @if(has_access('products'))
                                        <a href="{{ route('admin.sales.add') }}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add sale</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Invoice No.</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Customer Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Next Renew Date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($sales) > 0)
                                                @foreach($sales as $key => $sale)
                                                    @foreach($sale->saleItem as $key => $saleItem)
                                                        @if($saleItem->is_renewable == 1)
                                                            <tr class="tr-shadow">
                                                                <td>{{ optional($sale)->invoice_no }}</td>
                                                                <td>{{ optional($saleItem)->product->title }}</td>
                                                                <td>{{ optional($sale)->price }}</td>
                                                                <td>{{ optional($saleItem)->next_renew_date }}</td>
                                                                <td>{{ optional($sale->customer)->name }}</td>
                                                                <td>{{ optional($sale->customer)->email }}</td>
                                                                <td>{{ optional($sale->customer)->phone }}</td>
                                                                <td>
                                                                    <div class="table-data-feature">
                                                                        @if(has_access('products'))
                                                                        <a href="{{ route('admin.sales.detail', $sale->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                                            <i class="zmdi zmdi-eye"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if(has_access('products'))
                                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send Message" onclick="sendMessageModalShow({{ $sale->id }})">
                                                                            <i class="zmdi zmdi-email"></i>
                                                                        </button>
                                                                        @endif
                                                                        @if(has_access('products'))
                                                                        <a href="{{ route('admin.sales.download', $sale->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                                            <i class="zmdi zmdi-download"></i>
                                                                        </a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @else
                                            <tr class="tr-shadow">
                                                <td colspan="9" class="text-center">No Sale Found!</td>
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
							<h5 class="modal-title" id="staticModalLabel">Delete Sale</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure? All plans related to this sale will also be deleted.
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

            <!-- Send Message Modal -->
			<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true"
			 data-backdrop="static">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="messageModalLabel">Send Message</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Type message and send
							</p>
                            <input type="hidden" id="saleId" value="">
                            <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="sendMessage()">Send</button>
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

    function sendMessageModalShow(id){
        $('#saleId').val(id);
        $("#messageModal").modal("show");
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

    function sendMessage(){
        $("#messageModal").modal("hide");
        var id = $('#saleId').val();
        var message = $('#message').val();
        $.ajax({
            url: '{{ route('admin.sales.sendMessage') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                message: message,
            },
            success: function(response) {
                console.log(response)

            },
            error: function(xhr, status, error) {
                console.log(error);
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
