@extends('admin.layouts.app')

@section('title', 'Assignment Form')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
<style>
    .switch.switch-3d .switch-label {
        background-color: #b4b1b1;
    }
    .note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable {
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
                                            <h3 class="text-center title-2">@isset($assignment) Update @else Add @endisset Assignment</h3>
                                        </div>
                                        <hr>
                                        <form action="@isset($assignment){{ route('admin.assignment.update', $assignment->id) }}@else{{ route('admin.assignment.submit') }}@endisset" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="title" class="control-label mb-1">Project</label>
                                                        <select class="form-control" name="project_id" id="project_id">
                                                            <option value="">--Select Project--</option>
                                                            @foreach ($projects as $key => $project)
                                                                @isset($assignment)
                                                                    <option value="{{ $project->id }}"{{ $assignment->project_id==$project->id ? ' selected' : '' }}>{{ $project->title }}</option>
                                                                @else
                                                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
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
                                                        <label for="title" class="control-label mb-1">User</label>
                                                        <select class="form-control" name="user_id" id="user_id">
                                                            <option value="">--Select Employee--</option>
                                                            @foreach ($employees as $key => $employee)
                                                                @isset($assignment)
                                                                    <option value="{{ $employee->id }}"{{ $assignment->user_id==$employee->id ? ' selected' : '' }}>{{ $employee->name }}</option>
                                                                @else
                                                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                                @endisset
                                                            @endforeach
                                                        </select>
                                                        @error('user_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <label for="title" class="control-label mb-1">Task Title</label>
                                                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $assignment->title ?? old('title') }}" required>
                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <label for="task" class="control-label mb-1">Task Details</label>
                                                        <textarea name="task" id="task" rows="5" class="form-control @error('task') is-invalid @enderror">{{ $assignment->task ?? old('task') }}</textarea>
                                                        @error('task')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="deadline" class="control-label mb-1">Deadline</label>
                                                    <input name="deadline" type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" value="{{ $assignment->deadline ?? old('deadline') }}" required>
                                                    @error('deadline')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror 
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="title" class="control-label mb-1">Status</label>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="1"@isset($assignment) {{ $assignment->status==1 ? ' selected' : '' }} @endisset>Active</option>
                                                            <option value="2"@isset($assignment) {{ $assignment->status==2 ? ' selected' : '' }} @endisset>Completed</option>
                                                            <option value="3"@isset($assignment) {{ $assignment->status==3 ? ' selected' : '' }} @endisset>Cancelled</option>
                                                        </select>
                                                        @error('project_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-9">

                                                </div>
                                                <div class="col-sm-3">
                                                    <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" value="@isset($assignment) Update @else Submit @endisset">
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
@endsection

@push('js')
<script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script>
     $(document).ready(function () {
        $('#task').summernote();
     });
</script>
@endpush