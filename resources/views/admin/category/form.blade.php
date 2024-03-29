@extends('admin.layouts.app')

@section('title', 'Category Form')

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
                                    <h3 class="text-center title-2">
                                        @isset($category)
                                            Update
                                        @else
                                            Add New
                                        @endisset Category
                                    </h3>
                                </div>
                                <hr>
                                <form
                                    action="@isset($category){{ route('admin.sales.category.update', $category->id) }}@else{{ route('admin.sales.category.submit') }}@endisset"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Name</label>
                                                <input id="title" name="name" type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ $category->name ?? old('title') }}" required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @isset($category)
                                            <img id="icon"
                                                src="{{ asset('assets/images/uploads/category/icon/' . $category->icon) ?? asset('assets/images/defaultimage.png') }}"
                                                height="50px" width="50px" alt="your image" />
                                        @endisset
                                        <img id="icon" src="{{ asset('assets/images/defaultimage.png') }}"
                                            height="50px" width="50px" alt="your image" />
                                        <label for="icon" class="control-label mb-1">Icon /
                                            Image</label>
                                        <input id="icon" name="icon" type="file"
                                            class="form-control @error('icon') is-invalid @enderror">
                                        @error('icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="short_description" class="control-label mb-1">Short Description</label>
                                        <textarea name="short_description" id="short_description" rows="5"
                                            class="form-control @error('short_description') is-invalid @enderror">{{ $category->short_description ?? old('short_description') }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="long_description" class="control-label mb-1">Long Description</label>
                                        <textarea name="long_description" id="long_description" rows="5"
                                            class="form-control @error('long_description') is-invalid @enderror">{{ $category->long_description ?? old('long_description') }}</textarea>
                                        @error('long_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-9">
                                            {{-- key features --}}
                                            <h4 class="mb-2" style="color: black">Key Features</h4>
                                            <button onclick="addKeyFeature()" type="button" class="btn btn-success mb-3"
                                                style="margin-left: 10px">Add Field</button>
                                            <div class="row mb-2 example">
                                                <div class=" keyFeatureField">
                                                    @isset($category->keyFeature)
                                                        @foreach ($category->keyFeature as $key => $key_feature)
                                                            <input type="hidden" name="key_feature_id[]"
                                                                value="{{ $key_feature->id }}">
                                                            <div class="form-group d-flex">

                                                                <input id="key_features_title" placeholder="Title"
                                                                    name="key_features_title[]" type="text"
                                                                    class="form-control @error('key_features_title') is-invalid @enderror"
                                                                    value="{{ $key_feature->title ?? old('feature_title') }}">
                                                                @error('key_features_title')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <button type="button"
                                                                    style="background: crimson;
                 color: white;
                 padding: inherit;"
                                                                    onclick="RemoveKeyFeature({{ $key_feature->id }})">Remove</button>
                                                            </div>
                                                        @endforeach
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Status</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option
                                                        value="1"@isset($category) {{ $category->status == 1 ? ' selected' : '' }} @endisset>
                                                        Active</option>
                                                    <option
                                                        value="0"@isset($category) {{ $category->status == 0 ? ' selected' : '' }} @endisset>
                                                        Inactive</option>
                                                </select>
                                                @error('category_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9">

                                        </div>
                                        <div class="col-sm-3">
                                            <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"
                                                value="@isset($category) Update @else Submit @endisset">
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
            $('#long_description').summernote();
        });


        const RemoveKeyFeature = (id) => {
            console.log(id)

            var url = window.location.origin + '/admin/sales/category/key-feature/delete/' + id;
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(data) {
                    location.reload();
                    console.log(data)

                }
            });
        }



        const removeKeyFeature = (index) => {
            var keyObj = $('.keyFeature').eq(index);
            keyObj.remove();
            console.log(keyObj);
        }

        const addKeyFeature = () => {
            var index = $('.keyFeature').length; // Get the current number of key features

            var newField = `<div class="form-group keyFeature d-flex">
        <input id="key_features_title_${index}" placeholder="Title" name="key_features_title[]" type="text" class="form-control @error('title') is-invalid @enderror">
        @error('key_features_title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <button class="" style="    background: crimson;
    color: white;
    padding: 5px;" onclick="removeKeyFeature(${index})">remove</button>
    </div>`;

            $('.keyFeatureField').append(newField);
        };
    </script>
@endpush
