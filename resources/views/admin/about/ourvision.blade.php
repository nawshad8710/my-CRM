@extends('admin.layouts.app')

@section('title', 'About Our Vision')

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
                                    <h3 class="text-center title-2">
                                        @isset($ourVision)
                                            Update
                                        @else
                                            Add
                                        @endisset Our Vision
                                    </h3>
                                </div>
                                <hr>
                                <form action="{{ route('admin.about.ourVisionStore') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf


                                    <div class="form-group has-success">
                                        <label for="description" class="control-label mb-1">Description</label>
                                        <textarea name="description" id="description" rows="5"
                                            class="form-control @error('description') is-invalid @enderror">{{ optional($ourVision)->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        @isset($ourVision)
                                            <img id="image"
                                                src="{{ asset('assets/images/uploads/about/our-vision/' . $ourVision->image) ?? asset('assets/images/defaultimage.png') }}"
                                                height="50px" width="50px" alt="your image" />
                                        @else
                                            <img id="image" src="{{ asset('assets/images/defaultimage.png') }}"
                                                height="50px" width="50px" alt="your image" />
                                        @endisset

                                        <label for="image" class="control-label mb-1">Image</label>
                                        <input id="image" name="image" type="file"
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-9">

                                        </div>
                                        <div class="col-sm-3">
                                            <input type="submit" class="btn btn-lg btn-info mt-5 float-right"
                                                value="@isset($ourVision) Update @else Submit @endisset">
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
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endpush
