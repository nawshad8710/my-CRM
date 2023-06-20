@extends('admin.layouts.app')

@section('title', 'Our Achive Form')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
    <style>
        .switch.switch-3d .switch-label {
            background-color: #b4b1b1;
        }

        .note-editor.note-airframe .note-editing-area .note-editable,
        .note-editor.note-frame .note-editing-area .note-editable {
            margin-left: 10px;
        }

        input[type=checkbox],
        input[type=radio] {
            height: 25px;
            width: 25px;
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
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">
                                        Our Achive
                                    </h3>
                                </div>
                                <hr>
                                <form action="{{ route('admin.our-achive.storeAndUpdate') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Title</label>
                                                <input id="title" name="title" type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ optional($ourAchive)->title }}" required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group has-success">
                                        <label for="short_description" class="control-label mb-1">Short Description</label>
                                        <textarea name="short_description" id="short_description" rows="5"
                                            class="form-control @error('short_description') is-invalid @enderror">{{ optional($ourAchive)->short_description }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-9">

                                        </div>
                                        <div class="col-sm-3">
                                            <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"
                                                value="@isset($product) Update @else Submit @endisset">
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <button class="btn btn-success mb-2 ml-3" data-toggle="modal" data-target="#newModal"
                                        id="achiveButton">Add Achive Item</button>

                                    <div class="container">
                                        <table class="table border">
                                            <thead>
                                                <tr>
                                                    <th scope="col">sl.</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Subtitle</th>
                                                    <th scope="col">Icon</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($ourAchiveItems->count() > 0)
                                                    @foreach ($ourAchiveItems as $key => $ourAchiveItem)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ optional($ourAchiveItem)->title }}</td>
                                                            <td>{{ optional($ourAchiveItem)->sub_title }}</td>
                                                            <td>
                                                                <img class="thumbnail example-image"
                                                                    src="{{ asset('assets/images/uploads/our-achive/' . optional($ourAchiveItem)->icon) }}"
                                                                    alt="" width="100Px" height="100px"
                                                                    data-lightbox="example-1">
                                                            </td>
                                                            <td>
                                                                <div class="table-data-feature ">
                                                                    @if (has_access('update_assigned_task'))
                                                                        <Button data-target="editModal"
                                                                            onclick="editModalShow({{ $ourAchiveItem->id }})"
                                                                            class="item" data-toggle="tooltip"
                                                                            data-placement="top" title="Edit">
                                                                            <i class="zmdi zmdi-edit"></i>
                                                                        </button>
                                                                    @endif


                                                                    {{-- Edit Modal --}}
                                                                    <div class="modal fade" id="editModal" tabindex="-1"
                                                                        role="dialog" aria-labelledby="staticModalLabel"
                                                                        aria-hidden="true" data-backdrop="static">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <form id="updatedfrom" action="{{route('admin.our-achive.updateAchiveItem', $ourAchiveItem->id)}}" method="POST" enctype="multipart/form-data">

                                                                                    @csrf

                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="staticModalLabel">Edit
                                                                                            Achive Item</h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="conter">

                                                                                            <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            for="title"
                                                                                                            class="control-label mb-1">Heading</label>
                                                                                                        <input
                                                                                                            id="headingTitle"
                                                                                                            name="title"
                                                                                                            type="text"
                                                                                                            class="form-control @error('title') is-invalid @enderror"
                                                                                                            value="{{ optional($ourAchiveItem)->title }}"
                                                                                                            required>
                                                                                                        @error('title')
                                                                                                            <div
                                                                                                                class="invalid-feedback">
                                                                                                                {{ $message }}
                                                                                                            </div>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            for="sub_title"
                                                                                                            class="control-label mb-1">Sub
                                                                                                            Heading</label>
                                                                                                        <input
                                                                                                            id="sub_heading_title"
                                                                                                            name="sub_title"
                                                                                                            type="text"
                                                                                                            class="form-control @error('sub_title') is-invalid @enderror"
                                                                                                            value="{{ optional($ourAchiveItem)->sub_title }}"
                                                                                                            required>
                                                                                                        @error('sub_title')
                                                                                                            <div
                                                                                                                class="invalid-feedback">
                                                                                                                {{ $message }}
                                                                                                            </div>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-md-6">
                                                                                                    <img class="thumbnail example-image"
                                                                                                    src="{{ asset('assets/images/uploads/our-achive/' . $ourAchiveItem->icon) }}"
                                                                                                    alt="" width="100Px" height="100px"
                                                                                                    data-lightbox="example-1">
                                                                                                    <img id="frame"
                                                                                                        src=""
                                                                                                        class="img-fluid" />
                                                                                                    <div class="mb-5">
                                                                                                        <label
                                                                                                            for="icon"
                                                                                                            class="form-label">Upload
                                                                                                            Icon</label>
                                                                                                        <input
                                                                                                            class="form-control"
                                                                                                            name="icon"
                                                                                                            type="file"
                                                                                                            id="formFile"
                                                                                                            onchange="preview()">
                                                                                                        <button
                                                                                                            onclick="clearImage()"
                                                                                                            class="btn btn-danger mt-3">Remove</button>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit"
                                                                                            class="btn btn-success">Submit</button>
                                                                                        <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Cancel</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    @if (has_access('delete_assigned_task'))
                                                                        <button class="item" data-toggle="tooltip"
                                                                            data-placement="top" title="Delete"
                                                                            onclick="deleteModalShow({{ $ourAchiveItem->id }})">
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




                                                    {{-- {{ $ourAchiveItems->links() }} --}}
                                                @else
                                                    <tr>
                                                        <td>No Item Found</td>
                                                    </tr>
                                                @endif


                                            </tbody>
                                        </table>
                                        @if ($ourAchiveItems->hasPages())
                                            <nav>
                                                <ul class="pagination">
                                                    {{-- Previous Page Link --}}
                                                    @if ($ourAchiveItems->onFirstPage())
                                                        <li class="page-item disabled">
                                                            <span class="page-link">&laquo;</span>
                                                        </li>
                                                    @else
                                                        <li class="page-item">
                                                            <a class="page-link"
                                                                href="{{ $ourAchiveItems->previousPageUrl() }}"
                                                                rel="prev">&laquo;</a>
                                                        </li>
                                                    @endif

                                                    {{-- Pagination Elements --}}
                                                    @foreach ($ourAchiveItems as $element)
                                                        {{-- "Three Dots" Separator --}}
                                                        @if (is_string($element))
                                                            <li class="page-item disabled">
                                                                <span class="page-link">{{ $element }}</span>
                                                            </li>
                                                        @endif

                                                        {{-- Array Of Links --}}
                                                        @if (is_array($element))
                                                            @foreach ($ourAchiveItems as $page => $url)
                                                                @if ($page == $ourAchiveItems->currentPage())
                                                                    <li class="page-item active">
                                                                        <span class="page-link">{{ $page }}</span>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item">
                                                                        <a class="page-link"
                                                                            href="{{ $url }}">{{ $page }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach

                                                    {{-- Next Page Link --}}
                                                    @if ($ourAchiveItems->hasMorePages())
                                                        <li class="page-item">
                                                            <a class="page-link"
                                                                href="{{ $ourAchiveItems->nextPageUrl() }}"
                                                                rel="next">&raquo;</a>
                                                        </li>
                                                    @else
                                                        <li class="page-item disabled">
                                                            <span class="page-link">&raquo;</span>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </nav>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- Create Modal --}}
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.our-achive.storeAchiveItem') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticModalLabel">Add Achive Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="conter">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">Heading</label>
                                        <input id="title" name="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror" value=""
                                            required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sub_title" class="control-label mb-1">Sub Heading</label>
                                        <input id="sub_title" name="sub_title" type="text"
                                            class="form-control @error('sub_title') is-invalid @enderror" value=""
                                            required>
                                        @error('sub_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <img id="frame" src="" class="img-fluid" />
                                    <div class="mb-5">
                                        <label for="icon" class="form-label">Upload Icon</label>
                                        <input class="form-control" name="icon" type="file" id="formFile"
                                            onchange="preview()">
                                        <button onclick="clearImage()" class="btn btn-danger mt-3">Remove</button>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    {{-- delete data modal --}}
    <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Delete Assignment</h5>
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
@endsection

@push('js')
    {{-- <script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function() {
            $('#short_description').summernote();
            $('#long_description').summernote();
        });
</script> --}}

    <script>
        $(document).ready(function() {

            $('#achiveButton').click(function() {
                $('#newModal').appendTo("body").modal('show');
            });
        });


        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);

            frame.style.height = '100px';
            frame.style.width = '100px';
        }

        function clearImage() {
            document.getElementById('formFile').value = null;
            frame.src = "";

        }
    </script>


    <script>
        function deleteModalShow(id) {
            $('#deleteDataId').val(id);
            $("#staticModal").modal("show");
        }

        function deleteData() {
            $("#staticModal").modal("hide");
            var id = $('#deleteDataId').val();
            var url = window.location.origin + "/admin/our-achive/delete-achive-item/" + id;
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


        function editModalShow(id) {
            var id = id;

            $('#editModal').appendTo("body").modal('show');

        }
    </script>
@endpush
