@extends('admin.layouts.app')

@section('title', 'Why Choose Us')

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
                        <h3 class="title-5 m-b-35">Why Choose Us</h3>
                        <div class="table-data__tool">

                            <div class="table-data__tool-right">

                                <a href="{{ route('admin.why-choose-us.create') }}"
                                    class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Item</a>

                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Icon</th>
                                        <th>Short Description</th>
                                        <th>Long Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($why_choose_us)
                                        @if (count($why_choose_us) > 0)
                                            @foreach ($why_choose_us as $key => $whyChooseUs)
                                                <tr class="tr-shadow">
                                                    <td>{{ $whyChooseUs->title }}</td>
                                                    <td>
                                                        <img src="{{ asset('assets/images/uploads/why-choose-us/' . $whyChooseUs->icon) }}"
                                                            style="width: 50px; height:50px" alt="">
                                                    </td>
                                                    <td class="desc">
                                                        <?php
                                                        //$description =  strip_tags(html_entity_decode($user_project->task));
                                                        $short_description = $whyChooseUs->short_description;
                                                        if (strlen($short_description) > 30) {
                                                            // truncate string
                                                            $stringCut = substr($short_description, 0, 30);
                                                            $endPoint = strrpos($stringCut, ' ');

                                                            //if the string doesn't contain any space then it will cut without word basis.
                                                            //$desc = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                            $desc = $stringCut;
                                                            $desc .= '...';
                                                        }
                                                        ?>
                                                        @if (strlen($short_description) > 30)
                                                            {!! $desc !!}
                                                            <a href="#" class="desc-text"
                                                                onclick="shortDescModalShow({{ $whyChooseUs->id }})"> <u>View
                                                                    Details</u></a>
                                                        @else
                                                            {!! $whyChooseUs->short_description !!}
                                                        @endif
                                                        <!-- {!! Str::limit(
                                                            $short_description,
                                                            $limit = 30,
                                                            $end = '. . .<a href="#" class="desc-text" onclick="shortDescModalShow()">View Details</a>',
                                                        ) !!} -->
                                                        <div id="shortDescription{{ $whyChooseUs->id }}" class="d-none">
                                                            {!! $whyChooseUs->short_description !!}
                                                        </div>
                                                    </td>

                                                    <td class="desc">
                                                        <?php
                                                        //$description =  strip_tags(html_entity_decode($user_project->task));
                                                        $description = $whyChooseUs->long_description;
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
                                                                onclick="descModalShow({{ $whyChooseUs->id }})"> <u>View
                                                                    Details</u></a>
                                                        @else
                                                            {!! $whyChooseUs->long_description !!}
                                                        @endif

                                                        <div id="description{{ $whyChooseUs->id }}" class="d-none">
                                                            {!! $whyChooseUs->long_description !!}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">

                                                            <a href="{{ route('admin.why-choose-us.edit', $whyChooseUs->id) }}"
                                                                class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </a>


                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Delete" onclick="deleteModalShow({{ $whyChooseUs->id }})">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="tr-shadow">
                                                <td colspan="5" class="text-center">No Why Choose Us data Found!</td>
                                            </tr>
                                        @endif
                                    @endisset
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
                    <h5 class="modal-title" id="staticModalLabel">Delete Item</h5>
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
                    <h5 class="modal-title" id="scrollmodalLabel">Details</h5>
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
        function deleteModalShow(id) {
            $('#deleteDataId').val(id);
            $("#staticModal").modal("show");
        }

        function deleteData() {
            $("#staticModal").modal("hide");
            var id = $('#deleteDataId').val();
            var url = "delete/" + id;
            console.log(url)
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



        function shortDescModalShow(id) {
            this.event.preventDefault();
            var shortDescription = $('#shortDescription' + id).html();
            //alert(description);
            $("#taskDetailsWrapper").html(shortDescription);
            $("#scrollmodal").modal("show");
        }

        function descModalShow(id) {
            this.event.preventDefault();
            var description = $('#description' + id).html();
            //alert(description);
            $("#taskDetailsWrapper").html(description);
            $("#scrollmodal").modal("show");
        }
    </script>
@endpush
