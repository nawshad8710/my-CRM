@extends('employee.layouts.app')

@section('title', 'Project Reports')

@push('css')
    <style>
        .photo .table-data-feature .item {
            height: 50px;
            width: 50px;
        }
        td img {
            max-width: 50px;
            border: 3px solid #4272d7;
            border-radius: 5px;
        }
        .table-data2.table tbody td {
            padding: 0.75rem;
        }
        .desc-text {
            color: #ff8327;
            cursor: pointer;
        }

        .reportModalImage {
            width: 100%;
            margin-top: 30px;
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
                                <h3 class="title-5 m-b-35">Assigned Project Reports</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a href="{{ route('employee.report.add') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>new report</a>
                                        <!-- <div class="rs-select2--dark rs-select2--sm rs-select2--dark2 d-none">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Export</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Project</th>
                                                <th>Description</th>
                                                <th>Time Spent</th>
                                                <th>Photo</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($reports) > 0)
                                                @foreach($reports as $key => $report)
                                                <tr class="tr-shadow">
                                                    <td>{{ date('d-m-Y H:i a', strtotime($report->created_at)) }}</td>
                                                    <td>{{ $report->project->title }}</td>
                                                    <td class="desc">
                                                        <?php 
                                                            $description =  strip_tags(html_entity_decode($report->description));
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
                                                            {!! $desc !!}
                                                            <a href="#" class="desc-text" onclick="descModalShow({{ $report->id }})"> <u>View Details</u></a>
                                                        @else
                                                            {!! $report->description !!}
                                                        @endif
                                                        <!-- {!! Str::limit($description, $limit = 30, $end = '. . .<a href="#" class="desc-text" onclick="descModalShow()">View Details</a>') !!} -->
                                                        <div id="description{{ $report->id }}" class="d-none">
                                                            {!! $report->description !!}
                                                            @if($report->photo)
                                                                <img class="reportModalImage" id="reportModalImage" src="{{ asset('assets/images/uploads/reports') }}/{{ $report->photo }}">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ $report->spent_time ?? '-' }}</td>
                                                    <td>
                                                        @if($report->photo)
                                                            <div class="table-data-feature">
                                                                <img src="{{ asset('assets/images/uploads/reports') }}/{{ $report->photo }}" onclick="imageModalShow('{{ asset('assets/images/uploads/reports') }}/{{ $report->photo }}')" style="cursor: pointer;">
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                                <i class="zmdi zmdi-mail-send"></i>
                                                            </button> -->
                                                            @if($report && $report->project->status==1 && $report->user_project->status==1)
                                                                <a href="{{ route('employee.report.edit', $report->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </a>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteModalShow({{ $report->id }})">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            @endif
                                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                <i class="zmdi zmdi-more"></i>
                                                            </button> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr class="tr-shadow">
                                                <td colspan="6" class="text-center">No Report Found!</td>
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
							<h5 class="modal-title" id="staticModalLabel">Delete Report</h5>
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
			<!-- end modal delete -->

            <!-- modal image show -->
			<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="mediumModalLabel">Report Image</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<img id="reportModalImage" src="{{ asset('assets/images/uploads/reports/2022-10-31-635fee09bb737.jpg') }}" style="width: 100%;">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end modal image -->

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
							<div id="reportDetailsWrapper">
								
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

    function imageModalShow(src){
        $("#reportModalImage").attr("src", src);
        $("#mediumModal").modal("show");
    }
    
    function descModalShow(id){
        this.event.preventDefault();
        var description = $('#description'+id).html();
        //alert(description);
        $("#reportDetailsWrapper").html(description);
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