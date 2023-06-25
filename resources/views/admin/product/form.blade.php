@extends('admin.layouts.app')

@section('title', 'Product Form')

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
                                        @isset($product)
                                            Update
                                        @else
                                            Add New
                                        @endisset Product
                                    </h3>
                                </div>
                                <hr>
                                <form
                                    action="@isset($product){{ route('admin.sales.product.update', $product->id) }}@else{{ route('admin.sales.product.submit') }}@endisset"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Title</label>
                                                <input id="title" name="title" type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ $product->title ?? old('title') }}" required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="price" class="control-label mb-1">Price</label>
                                                <input id="price" name="price" type="text"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ $product->price ?? old('price') }}" required>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="short_description" class="control-label mb-1">Short Description</label>
                                        <textarea name="short_description" id="short_description" rows="5"
                                            class="form-control @error('short_description') is-invalid @enderror">{{ $product->short_description ?? old('short_description') }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="long_description" class="control-label mb-1">Long Description</label>
                                        <textarea name="long_description" id="long_description" rows="5"
                                            class="form-control @error('long_description') is-invalid @enderror">{{ $product->long_description ?? old('long_description') }}</textarea>
                                        @error('long_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Category</label>
                                                <select class="form-control" name="category_id" id="status" required>
                                                    <option value="">--Select category--</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @isset($product) {{ $product->category_id == $category->id ? ' selected' : '' }} @endisset>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Status</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="1"
                                                        @isset($product) {{ $product->status == 1
                                                            ? '
                                                                                                                                                                    selected'
                                                            : '' }} @endisset>
                                                        Active</option>
                                                    <option value="0"
                                                        @isset($product) {{ $product->status == 0
                                                            ? '
                                                                                                                                                                    selected'
                                                            : '' }} @endisset>
                                                        Inactive</option>
                                                </select>
                                                @error('product_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-check mt-4">
                                                <label for="title" class="control-label mb-1"></label>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    name="is_renewable" id="flexCheckDefault"
                                                    @isset($product) {{ $product->is_renewable == 1 ? ' checked' : '' }} @endisset>
                                                <label class="form-check-label ml-2 mt-1" for="flexCheckDefault">
                                                    Renewable Product
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- features --}}
                                    <h4>Features</h4>
                                    <button id="add-feature-button" type="button" class="btn btn-success mb-3"
                                        style="margin-left: 10px">Add Field</button>
                                    <div class="row featureField">
                                        @isset($product_feature)
                                            @foreach ($product_feature as $key => $feature)
                                            <div class="col-6"></div>
                                            <div class="col-6">
                                                <img class="thumbnail example-image"
                                                    src="{{ asset('assets/images/uploads/product/feature/' . optional($feature)->icon) }}"
                                                    alt="" width="100Px" height="100px" data-lightbox="example-1">
                                            </div>
                                                <div class="col-6 ">
                                                    <div class="form-group">
                                                        <label for="feature_title" class="control-label mb-1">Title</label>
                                                        <input id="feature_title" name="feature_title[]" type="text"
                                                            class="form-control @error('feature_title') is-invalid @enderror"
                                                            value="{{ $feature->title ?? old('feature_title') }}">
                                                        @error('feature_title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <label for="images" class="control-label mb-1">Image</label>
                                                    <input id="images" name="images[]" type="file"
                                                        class="form-control @error('images') is-invalid @enderror">
                                                </div>
                                            @endforeach
                                        @endisset


                                    </div>
                                    {{-- key features --}}
                                    <h4 class="mb-2" style="color: black">Key Features</h4>
                                    <button id="add-field-button" type="button" class="btn btn-success mb-3"
                                        style="margin-left: 10px">Add Field</button>
                                    <div class="row mb-2 example">
                                        <div class="col-md-6 keyFeatureField">
                                            @isset($product_key_feature)
                                                @foreach ($product_key_feature as $key => $key_feature)
                                                    <div class="form-group">

                                                        <input id="key_features_title" placeholder="Title"
                                                            name="key_features_title[]" type="text"
                                                            class="form-control @error('key_features_title') is-invalid @enderror"
                                                            value="{{ $key_feature->title ?? old('feature_title') }}">
                                                        @error('key_features_title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                            @endisset
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-9">

                                        </div>
                                        <div class="col-sm-3">
                                            <input id="payment-button" type="submit"
                                                class="btn btn-lg btn-info btn-block"
                                                value="@isset($product) Update @else Submit @endisset">
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
    </script>

    <script>
        $(document).ready(function() {
            $('#add-field-button').click(function() {
                var newField = `<div class="form-group">

                    <input id="key_features_title" placeholder="Title" name="key_features_title[]" type="text" class="form-control @error('title') is-invalid @enderror">
                    @error('key_features_title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
</div>`;
                $('.keyFeatureField').append(newField);
            });



            $('#add-feature-button').click(function() {
                var newFeatureField = `<div class="col-6 ">
                                        <div class="form-group">
                                            <label for="feature_title" class="control-label mb-1">Title</label>
                                            <input id="feature_title" name="feature_title[]" type="text"
                                                class="form-control @error('feature_title') is-invalid @enderror">
                                            @error('feature_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="images" class="control-label mb-1">Image</label>
                                        <input id="images" name="images[]" type="file"
                                            class="form-control @error('images') is-invalid @enderror">
                                    </div>`;
                $('.featureField').append(newFeatureField);
            });
        });
    </script>
@endpush
