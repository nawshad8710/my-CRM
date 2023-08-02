@extends('employee.layouts.app')

@section('title', 'Problems Form')

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
                                <h3 class="text-center title-2">@isset($problem) Update @else Add @endisset Problem</h3>
                            </div>
                            <hr>
                            <form
                                action="@isset($problem){{ route('employee.problem.updateProblem', $problem->id) }}@else{{ route('employee.problem.problemStore') }}@endisset"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="project_id" class="control-label mb-1">Project</label>
                                            <select class="form-control" name="project_id" id="project_id" >
                                                <option value="">--Select Project--</option>
                                                @foreach ($projects as $key => $project)
                                                    @isset($problem)
                                                        <option value="{{ $project->project_id }}"{{ $problem->project_id==$project->project_id ? ' selected' : '' }}>{{ $project->project->title }}</option>
                                                    @else
                                                    <option value="{{ $project->project_id }}">{{ $project->project->title }}</option>
                                                    @endisset
                                                @endforeach
                                            </select>
                                            @error('project_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="user_project_id" class="control-label mb-1">Task</label>
                                            <select class="form-control" name="user_project_id" id="user_project_id" >
                                                <option value="">--Select Task--</option>
                                                @isset($problem)
                                                    @foreach ($tasks as  $key => $task)
                                                        <option value="{{ $task->id }}" @isset($problem)
                                                            @if($task->id == $problem->user_project_id)
                                                                selected
                                                            @endif
                                                        @endisset>{{ $task->title }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('user_project_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="title" class="control-label mb-1">Problem Title</label>
                                        <input name="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ $problem->title ?? old('title') }}" required>
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group has-success">
                                            <label for="description" class="control-label mb-1">Problem Details</label>
                                            <textarea name="description" id="description" rows="5"
                                                class="form-control @error('description') is-invalid @enderror">{{ $problem->description ?? old('description') }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-sm-6">
                                        <label for="date" class="control-label mb-1">Date</label>
                                        <input name="date" type="datetime-local"
                                            class="form-control @error('date') is-invalid @enderror"
                                            value="{{ $problem->date ?? old('date') }}" required>
                                        @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="1" @isset($problem) {{ $problem->status==1 ? ' selected'
                                                    : '' }} @endisset>Active</option>
                                                <option value="2" @isset($problem) {{ $problem->status==2 ? ' selected'
                                                    : '' }} @endisset>Completed</option>
                                                <option value="3" @isset($problem) {{ $problem->status==3 ? ' selected'
                                                    : '' }} @endisset>Cancelled</option>
                                            </select>
                                            @error('project_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-sm-9">

                                        <label for="photo" class="control-label mb-1">Profile Photo</label>
                                        @isset($problem)
                                        <div class="row">
                                            <div class="col-6">
                                                @foreach($imageNames as $imageName)
                                                <img class="thumbnail"
                                                    src="{{ asset('assets/images/uploads/problems/' . $imageName) }}"
                                                    alt="" width="100Px" height="100px">
                                                @endforeach

                                            </div>
                                            <div class="col-6">
                                                <input name="images[]" type="file"
                                                    class="form-control @error('images') is-invalid @enderror" multiple>
                                                @error('images')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>
                                        @else
                                        <input name="images[]" multiple type="file"
                                            class="form-control @error('images') is-invalid @enderror" required>
                                        @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @endisset

                                    </div>
                                    <div class="col-sm-3">
                                        <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"
                                            value="@isset($problem) Update @else Submit @endisset">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Company</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Company</label>
                                            <input type="text" id="company" placeholder="Enter your company name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">VAT</label>
                                            <input type="text" id="vat" placeholder="DE1234567890" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class=" form-control-label">Street</label>
                                            <input type="text" id="street" placeholder="Enter street name" class="form-control">
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="city" class=" form-control-label">City</label>
                                                    <input type="text" id="city" placeholder="Enter your city" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="postal-code" class=" form-control-label">Postal Code</label>
                                                    <input type="text" id="postal-code" placeholder="Postal Code" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="country" class=" form-control-label">Country</label>
                                            <input type="text" id="country" placeholder="Country name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div> -->
            </div>
        </div>
    </div>
</div>


{{-- full image modal --}}
<div id="fullImageModal" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Full-size Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid zoomable-image" src="" alt="Full-size Image">
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#description').summernote();
     });

     $( "#project_id" ).change(function() {
            var project_id = $(this).val();
            var url = window.location.origin + '/employee/assignment/get-assignments-by-project/' + project_id;
            if(project_id > 0){
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            var html = `<option value="">--Select Task--</option>`;
                            $.each(data, function (key, val) { 
                                html += `<option value="${val.id}">${val.title}</option>`;
                            });
                            $('#user_project_id').html(html);
                        }
                    }
                });
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

  $('#fullImageModal').on('hidden.bs.modal', function () {
    $('#fullImageModal .modal-body img').attr('src', '');
  });
});

</script>
@endpush