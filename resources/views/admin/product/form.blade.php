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

        .feature-div {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }


        .image-div {
            border: 1px solid;
        }

        .title-div {
            border: 1px solid;
            margin-left: 20px;
            padding: 3px;
        }

        .remove-button-div>button {
            margin-left: 20px;
            /* background: red; */
            color: red;
            padding: 3px
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
                                    @isset($product)
                                        <img src="{{ asset('assets/images/uploads/product/upper-video-thumbnail/' . $product->upper_video_thumbnail) }}"
                                            alt="" style="width:100px; height: 100px">
                                    @endisset
                                    <div class="row">

                                        <div class="col-md-6 mt-4">

                                            <div class="form-control">
                                                <label for="upper_video_thumbnail" class="control-label mb-1">Upper Video
                                                    Thumbnail</label>
                                                <input id="upper_video_thumbnail" name="upper_video_thumbnail"
                                                    type="file"
                                                    class="form-control @error('upper_video_thumbnail') is-invalid @enderror">

                                            </div>

                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="upper_video_link" class="control-label mb-1">Upper Video
                                                    Link</label>
                                                <input id="upper_video_link" name="upper_video_link" type="text"
                                                    class="form-control @error('upper_video_link') is-invalid @enderror"
                                                    value="{{ $product->upper_video_link ?? old('upper_video_link') }}"
                                                    required>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-4 mb-4">
                                            @isset($product)
                                                <img src="{{ asset('assets/images/uploads/product/lower-video-thumbnail/' . $product->lower_video_thumbnail) }}"
                                                    alt="" style="width:100px; height: 100px">
                                            @endisset
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-control">
                                                <label for="lower_video_thumbnail" class="control-label mb-1">Lower Video
                                                    Thumbnail</label>
                                                <input id="lower_video_thumbnail" name="lower_video_thumbnail"
                                                    type="file"
                                                    class="form-control @error('lower_video_thumbnail') is-invalid @enderror">

                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lower_video_link" class="control-label mb-1">Lower Video
                                                    Link</label>
                                                <input id="lower_video_link" name="lower_video_link" type="text"
                                                    class="form-control @error('upper_video_link') is-invalid @enderror"
                                                    value="{{ $product->lower_video_link ?? old('lower_video_link') }}"
                                                    required>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>



                                    {{-- demo feature  --}}
                                    {{-- <div class="feature-div">
                                        <div class="image-div">
                                            <input type="file" name="" id="">
                                        </div>

                                        <div class="title-div">

                                            <input type="text" placeholder="Title" name="" id="" >
                                        </div>
                                        <div class="remove-button-div">
                                            <button type="button">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div> --}}
                                    {{-- features --}}
                                    <h4>Features</h4>
                                    <button onclick="addOption()" id="add-feature-button" type="button"
                                        class="btn btn-success mb-3" style="margin-left: 10px">Add Field</button>
                                    <div class="row featureField">
                                        @isset($product->feature)
                                            @foreach ($product->feature as $key => $feature)
                                                <input type="hidden" name="feature_id[]" value="{{ $feature->id }}">
                                                <div class="col-5"></div>
                                                <div class="col-5">
                                                    <img class="thumbnail example-image"
                                                        src="{{ asset('assets/images/uploads/product/feature/' . optional($feature)->icon) }}"
                                                        alt="" width="100Px" height="100px"
                                                        data-lightbox="example-1">
                                                </div>
                                                <div class="col-5 ">
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

                                                <div class="col-5">
                                                    <label for="images" class="control-label mb-1">Image</label>
                                                    <input id="images" name="images[]" type="file"
                                                        class="form-control @error('images') is-invalid @enderror">
                                                    <input type="hidden" class="is-currect-option-default-value"
                                                        name="images[]" value="0"
                                                        {{ $feature->icon ? 'disabled' : '' }} />
                                                </div>
                                                <div class="col-2">
                                                    <button type="button"
                                                        onclick="RemoveItem({{ $feature->id }})">Remove</button>
                                                </div>
                                            @endforeach
                                        @endisset


                                    </div>
                                    {{-- key features --}}
                                    <h4 class="mb-2" style="color: black">Key Features</h4>
                                    <button onclick="addKeyFeature()" type="button" class="btn btn-success mb-3"
                                        style="margin-left: 10px">Add Field</button>
                                    <div class="row mb-2 example">
                                        <div class="col-md-6 keyFeatureField">
                                            @isset($product->keyFeature)
                                                @foreach ($product->keyFeature as $key => $key_feature)
                                                    <input type="hidden" name="key_feature_id[]"
                                                        value="{{ $key_feature->id }}">
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
        const RemoveItem = (id) => {
            console.log(id)

            var url = window.location.origin + '/admin/sales/product/feature/delete/' + id;
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



        const removeOption = () => {
            var $obj = $('.Option');
            $obj.remove();
            console.log($obj);
        }

        const addOption = () => {

            var newFeatureField = `<div class="col-6 Option">
                        <div class="form-group">
                            <label for="feature_title" class="control-label mb-1">Title</label>
                            <input id="feature_title" name="feature_title[]" type="text"
                                class="form-control @error('feature_title') is-invalid @enderror">
                            @error('feature_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 Option">
                        <label for="images" class="control-label mb-1">Image</label>
                        <input id="images" name="images[]" type="file"
                            class="form-control @error('images') is-invalid @enderror">
                    </div>
                    <buttton class="Option" onclick="removeOption(this)">remove</button>`;
            $('.featureField').append(newFeatureField);

        }


        const removeKeyFeature = () => {
            var keyObj = $('.keyFeature');
            keyObj.remove();
        }


        const addKeyFeature = () => {
            var newField = `<div class="form-group keyFeature">

                <input id="key_features_title" placeholder="Title" name="key_features_title[]" type="text" class="form-control @error('title') is-invalid @enderror">
                    @error('key_features_title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
                <buttton class="keyFeature" onclick="removeKeyFeature(this)">remove</button>
                `;
            $('.keyFeatureField').append(newField);
        };
    </script>
@endpush
