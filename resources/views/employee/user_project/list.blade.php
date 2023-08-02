@extends('employee.layouts.app')

@section('title', 'Assignments')

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
                                <h3 class="title-5 m-b-35">Assigned Project List</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="status" id="status">
                                                <option selected="selected" value="">Status</option>
                                                <option value="0" @isset($_GET['status']) @if($_GET['status']==0) selected @endif @endisset)>Pending</option>
                                                <option value="1" @isset($_GET['status']) @if($_GET['status']==1) selected @endif @endisset)>Active</option>
                                                <option value="2" @isset($_GET['status']) @if($_GET['status']==2) selected @endif @endisset)>Completed</option>
                                                <option value="3" @isset($_GET['status']) @if($_GET['status']==3) selected @endif @endisset)>Cancelled</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <!-- <button class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>filters</button> -->
                                    </div>
                                    <div class="table-data__tool-right">
                                        
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
                                                <th>Project</th>
                                                <th>Task</th>
                                                <th>Deadline</th>
                                                <th>Status</th>
                                                <!-- <th class="text-center">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($user_projects) > 0)
                                                @foreach($user_projects as $key => $user_project)
                                                <tr class="tr-shadow">
                                                    <td>{{ $user_project->project->title }}</td>
                                                    <td class="desc">
                                                        <?php 
                                                            //$description =  strip_tags(html_entity_decode($user_project->task));
                                                            $description =  $user_project->task;
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
                                                            <a href="#" class="desc-text" onclick="descModalShow({{ $user_project->id }})"> <u>View Details</u></a>
                                                        @else
                                                            {!! $user_project->task !!}
                                                        @endif
                                                        <!-- {!! Str::limit($description, $limit = 30, $end = '. . .<a href="#" class="desc-text" onclick="descModalShow()">View Details</a>') !!} -->
                                                        <div id="description{{ $user_project->id }}" class="d-none">
                                                            {!! $user_project->task !!}
                                                        </div>
                                                    </td>
                                                    <td>{{ date('d-m-Y H:i a', strtotime($user_project->deadline)) }}</td>
                                                    <td class="text-center">
                                                        @if($user_project->status == 0)
                                                            <!-- <span class="status--process">Active</span> -->
                                                            <span class="badge badge-secondary">Pending</span>
                                                        @elseif($user_project->status == 1)
                                                            <span class="badge badge-primary">Active</span>
                                                        @elseif($user_project->status == 2)
                                                            <span class="badge badge-success">Completed</span>
                                                        @elseif($user_project->status == 3)
                                                            <span class="badge badge-danger">Cancelled</span>    
                                                        @endif
                                                    </td>
                                                    <!-- <td>
                                                        <div class="table-data-feature">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                                <i class="zmdi zmdi-mail-send"></i>
                                                            </button>
                                                            <a href="{{ route('admin.assignment.edit', $user_project->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </a>
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteModalShow({{ $user_project->id }})">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                <i class="zmdi zmdi-more"></i>
                                                            </button>
                                                        </div>
                                                    </td> -->
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr class="tr-shadow">
                                                <td colspan="6" class="text-center">No Assignment Found!</td>
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
            

            <!-- modal description -->
			<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="scrollmodalLabel">Task Details</h5>
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
@endsection

@push('js')
<script>

    function descModalShow(id){
        this.event.preventDefault();
        var description = $('#description'+id).html();
        //alert(description);
        $("#taskDetailsWrapper").html(description);
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