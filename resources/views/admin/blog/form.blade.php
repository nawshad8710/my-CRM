@extends('admin.layouts.app')

@section('title', 'Blog Form')

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
                                        @isset($blog)
                                            Update
                                        @else
                                            Add New
                                        @endisset Blog
                                    </h3>
                                </div>
                                <hr>
                                <form
                                    action="@isset($blog){{ route('admin.blog.update', $blog->id) }}@else{{ route('admin.blog.store') }}@endisset"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Title</label>
                                                <input id="title" name="title" type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ $blog->title ?? old('title') }}" required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                @isset($blog)
                                                    <img id="image"
                                                        src="{{ asset('assets/images/uploads/blog/' . $blog->image) ?? asset('assets/images/defaultimage.png') }}"
                                                        height="50px" width="50px" alt="your image" />
                                                @endisset
                                                <img id="image" src="{{ asset('assets/images/defaultimage.png') }}"
                                                    height="50px" width="50px" alt="your image" />
                                                <label for="image" class="control-label mb-1">Image</label>
                                                <input id="image" name="image" type="file"
                                                    class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="short_description" class="control-label mb-1">Short
                                                Description</label>
                                            <textarea name="short_description" id="short_description" rows="5"
                                                class="form-control @error('short_description') is-invalid @enderror">{{ $blog->short_description ?? old('short_description') }}</textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="description" class="control-label mb-1">
                                                Description</label>
                                            <textarea name="description" id="description" rows="5"
                                                class="form-control @error('description') is-invalid @enderror">{{ $blog->description ?? old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>



                                    <div class="row">
                                        <div class="col-sm-9">

                                        </div>
                                        <div class="col-sm-3">
                                            <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"
                                                value="@isset($blog) Update @else Submit @endisset">
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
            $('#short_description').summernote();
            $('#description').summernote();
        });
    </script>
@endpush
