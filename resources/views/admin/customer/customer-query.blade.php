@extends('admin.layouts.app')

@section('title', 'Customer')

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
                    <h3 class="title-5 m-b-35">Customer List</h3>
                    <div class="table-data__tool">
                        {{-- <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--sm">
                                <select class="js-select2" name="status" id="status">
                                    <option selected="selected" value="">Status</option>
                                    <option value="1" @isset($_GET['status']) @if($_GET['status']==1) selected @endif
                                        @endisset)>Active</option>
                                    <option value="0" @isset($_GET['status']) @if($_GET['status']==0) selected @endif
                                        @endisset)>Inactive</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>

                        </div> --}}

                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($customers) > 0)
                                @foreach($customers as $key => $customer)
                                <tr class="tr-shadow">
                                    <td>{{$key+1}}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>
                                        <span class="block-email">{{ $customer->email }}</span>
                                    </td>
                                    <td>{{ $customer->phone }}</td>

                                    <td class="desc">
                                        <?php
                                            //$description =  strip_tags(html_entity_decode($user_project->task));
                                            $description =  $customer->subject;
                                            if (strlen($description) > 30) {

                                                // truncate string
                                                $stringCut = substr($description, 0, 30);
                                                $endPoint = strrpos($stringCut, ' ');

                                                //if the string doesn't contain any space then it will cut without word basis.
                                                //$desc = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                $desc = $stringCut;
                                                $desc .= '...';
                                            }
                                        ?>
                                        @if (strlen($description) > 30)
                                            {!! $desc !!}
                                            <a href="#" class="desc-text" onclick="descModalShow({{ $customer->id }})"> <u>View Details</u></a>
                                        @else
                                            {!! $customer->subject !!}
                                        @endif
                                        <!-- {!! Str::limit($description, $limit = 30, $end = '. . .<a href="#" class="desc-text" onclick="descModalShow()">View Details</a>') !!} -->
                                        <div id="description{{ $customer->id }}" class="d-none">
                                            {!! $customer->subject !!}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="table-data-feature">


                                            <button onclick="viewModalShow({{ $customer->id }})" class="item"
                                                data-toggle="tooltip" data-placement="top" title="view">
                                                <i class="zmdi zmdi-eye"></i>
                                            </button>

                                            @if(has_access('delete_customer'))
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="Delete" onclick="deleteModalShow({{ $customer->id }})">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="tr-shadow">
                                    <td colspan="8" class="text-center">No Customer Found!</td>
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
<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Delete Customer</h5>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal"
                    onclick="deleteData()">Confirm</button>
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
                <h5 class="modal-title" id="scrollmodalLabel">Query Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="taskDetailsWrapper">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal description -->


<!-- view details modal-->
<div class="modal fade" id="viewdetailsModal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Customer Query Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="">
                        <p>Customer Name :</p>
                    <p>Customer Email :</p>
                    <p>Customer Phone :</p>
                    </div>
                    <div class="">
                        <p id="customerName"></p>
                    <p id="customerEmail"></p>
                    <p id="customerPhone"></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <p>Customer Message:</p>
<hr>
                    <p id="customerMessage"></p>
                </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end view details details modal-->



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
        var url = "customer-query-delete/"+id;
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

    function descModalShow(id){
        this.event.preventDefault();
        var description = $('#description'+id).html();
        //alert(description);
        $("#taskDetailsWrapper").html(description);
        $("#scrollmodal").modal("show");
    }

    function viewModalShow(id){
      $('#viewdetailsModal').modal("show");
      var url = window.location.origin + "/admin/customer/single-customer-query/"+id;
      console.log(url)
      $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            success: function (response) {

                $('#customerName').text(response.name);
                $('#customerEmail').text(response.email);
                $('#customerPhone').text(response.phone);
                $('#customerMessage').text(response.subject);
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
