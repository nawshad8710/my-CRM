@extends('admin.layouts.app')

@section('title', 'Banner')

@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}"> --}}
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
                                        @isset($banner)
                                            Update
                                        @else
                                            Add
                                        @endisset Banner
                                    </h3>
                                </div>
                                <hr>
                                <form action="{{ route('admin.banner.storeAndUpdate') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="heading" class="control-label mb-1">Heading</label>
                                        <input id="heading" name="heading" type="text"
                                            class="form-control @error('heading') is-invalid @enderror"
                                            value="{{ $banner->heading ?? old('heading') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group has-success">
                                        <label for="short_description" class="control-label mb-1">Short Description</label>
                                        <textarea name="short_description" id="short_description" rows="5"
                                            class="form-control @error('short_description') is-invalid @enderror">{{ optional($banner)->short_description }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                          @isset($banner)
                                          <img id="image" src="{{ asset('assets/images/uploads/banner/' . $banner->image) ?? asset('assets/images/defaultimage.png') }}" height="150px" width="150px" alt="your image" />
                                          @endisset
                                          <img id="image" src="{{ asset('assets/images/defaultimage.png') }}" height="150px" width="150px" alt="your image" />
                                            <label for="image" class="control-label mb-1">Image</label>
                                            <input id="image" name="image" type="file" class="form-control @error('image') is-invalid @enderror" >
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-9">

                                        </div>
                                        <div class="col-sm-3">
                                            <input type="submit" class="btn btn-lg btn-info mt-5 float-right"
                                                value="@isset($banner) Update @else Submit @endisset">
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
    {{-- <script>
        $(document).ready(function() {
            $('#short_description').summernote();
            $('#long_description').summernote();
        });
    </script> --}}
@endpush
