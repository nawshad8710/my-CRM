@extends('admin.layouts.app')

@section('title', 'Career')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
<style>
    .switch.switch-3d .switch-label {
        background-color: #b4b1b1;
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
                                            <h3 class="text-center title-2">@isset($career) Update @else Add @endisset Career</h3>
                                        </div>
                                        <hr>
                                        <form action="{{ route('admin.career.index') }}" method="post" enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group has-success">
                                                <label for="short_description" class="control-label mb-1">Short Description</label>
                                                <textarea name="short_description" id="short_description" rows="5"
                                                    class="form-control @error('short_description') is-invalid @enderror">{{ optional($career)->short_description }}</textarea>
                                                @error('long_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="long_description" class="control-label mb-1">Long Description</label>
                                                <textarea name="long_description" id="long_description" rows="5"
                                                    class="form-control @error('long_description') is-invalid @enderror">{{ optional($career)->long_description }}</textarea>
                                                @error('long_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-9">

                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="submit" class="btn btn-lg btn-info mt-5 float-right" value="@isset($career) Update @else Submit @endisset">
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
