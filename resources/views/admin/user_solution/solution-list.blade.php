@extends('admin.layouts.app')

@section('title', 'Admin')

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
                        <h3 class="title-5 m-b-35">Solution List</h3>
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="rs-select2--light rs-select2--sm">
                                    <select class="js-select2" name="status" id="status">
                                        <option selected="selected" value="">Status</option>
                                        <option value="0"
                                            @isset($_GET['status']) @if ($_GET['status'] == 0) selected @endif
                                        @endisset)>
                                            Pending</option>
                                        <option value="1"
                                            @isset($_GET['status']) @if ($_GET['status'] == 1) selected @endif
                                        @endisset)>
                                            Active</option>
                                        <option value="2"
                                            @isset($_GET['status']) @if ($_GET['status'] == 2) selected @endif
                                        @endisset)>
                                            Completed</option>
                                        <option value="3"
                                            @isset($_GET['status']) @if ($_GET['status'] == 3) selected @endif
                                        @endisset)>
                                            Cancelled</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <!-- <button class="au-btn-filter">
                                               <i class="zmdi zmdi-filter-list"></i>filters</button> -->
                            </div>
                            @if (has_access('create_solution'))
                                <div class="table-data__tool-right">

                                    <a href="{{ route('admin.assignment.solutionCreate') }}"
                                        class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>Add Solution</a>

                                </div>
                            @endif

                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>User</th>
                                        <th>Task</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        {{-- <th>Status</th> --}}
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($solutions) > 0)
                                        @foreach ($solutions as $key => $solution)
                                            <tr class="tr-shadow">
                                                <td>{{ $solution->project->title }}</td>
                                                <td>{{ $solution->user->name }}</td>
                                                <td>{!! $solution->user_project->task !!}</td>
                                                <td class="desc">
                                                    <?php
                                                    //$description =  strip_tags(html_entity_decode($user_project->task));
                                                    $description = $solution->description;
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
                                                        <a href="#" class="desc-text"
                                                            onclick="descModalShow({{ $solution->id }})">
                                                            <u>View Details</u></a>
                                                    @else
                                                        {!! $solution->description !!}
                                                    @endif

                                                    <div id="description{{ $solution->id }}" class="d-none">
                                                        {!! $solution->description !!}
                                                    </div>
                                                </td>

                                                <td>{{ date('d-m-Y H:i a', strtotime($solution->created_at)) }}</td>
                                                {{-- <td class="text-center">
                                                    @if ($solution->status == 0)
                                                        <!-- <span class="status--process">Active</span> -->
                                                        <span class="badge badge-secondary">Pending</span>
                                                    @elseif($solution->status == 1)
                                                        <span class="badge badge-primary">Active</span>
                                                    @elseif($solution->status == 2)
                                                        <span class="badge badge-success">Completed</span>
                                                    @elseif($solution->status == 3)
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    <div class="table-data-feature">
                                                        @if (has_access('update_solution'))
                                                            <a href="{{ route('admin.assignment.solutionEdit', $solution->id) }}"
                                                                class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </a>
                                                        @endif
                                                        @if (has_access('delete_solution'))
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete"
                                                                onclick="deleteModalShow({{ $solution->id }})">
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
    <!-- modal static -->
    <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Delete Problem</h5>
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
    <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollmodalLabel">Description Details</h5>
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


    {{-- full image modal --}}

@endsection

@push('js')
    <script>
        function deleteModalShow(id) {
            $('#deleteDataId').val(id);
            $("#staticModal").modal("show");
        }

        function deleteData() {
            $("#staticModal").modal("hide");
            var id = $('#deleteDataId').val();
            var url = "delete/" + id;
            console.log(url, id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.statusText);
                }
            });
        }

        function descModalShow(id) {
            this.event.preventDefault();
            var description = $('#description' + id).html();
            //alert(description);
            $("#taskDetailsWrapper").html(description);
            $("#scrollmodal").modal("show");
        }

        $("#status").change(function() {
            var status = $("#status").val();
            if (status) {
                var url = window.location.origin + window.location.pathname + "?filter=1&status=" + status;
                location = url;
            } else {
                var url = window.location.origin + window.location.pathname;
                location = url;
            }

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.thumbnail').click(function() {
                var fullImagePath = $(this).attr('src');
                $('#fullImageModal .modal-body img').attr('src', fullImagePath);
                $('#fullImageModal').modal('show');
            });

            $('#fullImageModal').on('hidden.bs.modal', function() {
                $('#fullImageModal .modal-body img').attr('src', '');
            });
        });
    </script>
@endpush
