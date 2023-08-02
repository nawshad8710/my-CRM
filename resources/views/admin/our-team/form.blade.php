@extends('admin.layouts.app')

@section('title', 'Our Team Form')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
<style>
    .switch.switch-3d .switch-label {
        background-color: #b4b1b1;
    }
    .note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable {
        margin-left: 10px;
    }
    input[type=checkbox], input[type=radio] {
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
                                            <h3 class="text-center title-2">@isset($ourTeam) Update @else Add New @endisset Our Team</h3>
                                        </div>
                                        <hr>
                                        <form action="@isset($ourTeam){{ route('admin.our-team.update', $ourTeam->id) }}@else{{ route('admin.our-team.store') }}@endisset" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label mb-1">Name</label>
                                                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $ourTeam->name ?? old('name') }}" required>
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                      @isset($ourTeam)
                                                      <img id="image" src="{{ asset('assets/images/uploads/our-team/' . $ourTeam->image) ?? asset('assets/images/defaultimage.png') }}" height="50px" width="50px" alt="your image" />
                                                      @endisset
                                                      <img id="image" src="{{ asset('assets/images/defaultimage.png') }}" height="50px" width="50px" alt="your image" />
                                                        <label for="image" class="control-label mb-1">Image</label>
                                                        <input id="image" name="image" type="file" class="form-control @error('image') is-invalid @enderror" >
                                                        @error('image')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="designation" class="control-label mb-1">Designation</label>
                                                        <input id="designation" name="designation" type="text" class="form-control @error('designation') is-invalid @enderror" value="{{ $ourTeam->designation ?? old('designation') }}" required>
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @isset($ourTeam)

                                                <div class="col-6">
                                                    <div class="form-check" style="display: flex; align-items: center;">
                                                        <input class="form-check-input" type="radio" name="field" id="flexRadioDefault1" value="sales" {{ $ourTeam->field == 'sales' ? 'checked' : '' }}>
                                                        <label class="form-check-label" style="margin-left: 10px" for="flexRadioDefault1">
                                                            Sales
                                                        </label>
                                                    </div>
                                                    <div class="form-check" style="display: flex; align-items: center;">
                                                        <input class="form-check-input" type="radio" name="field" id="flexRadioDefault2" value="development" {{ $ourTeam->field == 'development' ? 'checked' : '' }}>
                                                        <label class="form-check-label" style="margin-left: 10px" for="flexRadioDefault2">
                                                            Development
                                                        </label>
                                                    </div>

                                                </div>
                                                @else
                                                <div class="col-6">
                                                    <div class="form-check" style="display: flex; align-items: center;">
                                                        <input class="form-check-input" type="radio" name="field" id="flexRadioDefault1" value="sales">
                                                        <label class="form-check-label" style="margin-left: 10px" for="flexRadioDefault1">
                                                          Sales
                                                        </label>
                                                      </div>
                                                      <div class="form-check" style="display: flex; align-items: center;">
                                                        <input class="form-check-input" type="radio" name="field" id="flexRadioDefault2" value="development">
                                                        <label class="form-check-label" style="margin-left: 10px" for="flexRadioDefault2">
                                                          Development
                                                        </label>
                                                      </div>
                                                </div>

                                                @endisset

                                            </div>



                                            <div class="row">
                                                <div class="col-sm-9">

                                                </div>
                                                <div class="col-sm-3">
                                                    <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" value="@isset($ourTeam) Update @else Submit @endisset">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('js')
<script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script>
     $(document).ready(function () {
        $('#short_description').summernote();
        $('#long_description').summernote();
     });
</script>
@endpush
