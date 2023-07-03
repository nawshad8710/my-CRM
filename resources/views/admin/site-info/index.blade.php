@extends('admin.layouts.app')

@section('title', 'Site Info')

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
                                <form action="{{ route('admin.site-info.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <img id="Logo"
                                                src="{{ asset('assets/images/uploads/site-info/logo/' . $siteInfo->logo) ?? asset('assets/images/defaultimage.png') }}"
                                                height="43px" width="180px" alt="your image" />

                                            <div class="mb-3">

                                                <label for="formFile" class="form-label">Logo</label>
                                                <input class="form-control" name="logo" onchange="logoImage(this);"
                                                    type="file" id="formFile">
                                            </div>
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Title</label>
                                                <input id="title" name="title" type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ optional($siteInfo)->title }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="control-label mb-1">Email</label>
                                                <input id="email" name="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ optional($siteInfo)->email }}">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="short_description" class="control-label mb-1">Short
                                                    Description</label>
                                                <textarea name="short_description" id="description" rows="5"
                                                    class="form-control @error('short_description') is-invalid @enderror" required>{{ $siteInfo->short_description ?? old('short_description') }}</textarea>
                                                @error('short_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_keyword" class="control-label mb-1">Meta Keyword</label>
                                                <input id="meta_keyword" name="meta_keyword" type="text"
                                                    class="form-control @error('meta_keyword') is-invalid @enderror"
                                                    value="{{ optional($siteInfo)->meta_keyword }}">
                                                @error('meta_keyword')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="meta_description" class="control-label mb-1">Meta
                                                    Description</label>
                                                <textarea name="meta_description" id="meta_description" rows="5"
                                                    class="form-control @error('meta_description') is-invalid @enderror" required>{{ $siteInfo->short_description ?? old('meta_description') }}</textarea>
                                                @error('meta_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="vat" class="control-label mb-1">Vat(%)</label>
                                                <input id="vat" name="vat" type="text"
                                                    class="form-control @error('vat') is-invalid @enderror"
                                                    value="{{ optional($siteInfo)->vat }}">
                                                @error('vat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <img id="FavIcon"
                                                    src="{{ asset('assets/images/uploads/site-info/fav-icon/' . $siteInfo->fav_icon) ?? asset('assets/images/defaultimage.png') }}"
                                                    height="43px" width="180px" alt="your image" />
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Fav Icon</label>
                                                    <input class="form-control" name="fav_icon" type="file"
                                                        id="formFile" onchange="favImage(this)">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sub_title" class="control-label mb-1">Sub Title</label>
                                                    <input id="sub_title" name="sub_title" type="text"
                                                        class="form-control @error('sub_title') is-invalid @enderror"
                                                        value="{{ optional($siteInfo)->sub_title }}">
                                                    @error('sub_title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone" class="control-label mb-1">Phone</label>
                                                    <input id="phone" name="phone" type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        value="{{ optional($siteInfo)->phone }}">
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group has-success">
                                                    <label for="address" class="control-label mb-1">Address</label>
                                                    <textarea name="address" id="description" rows="5" class="form-control @error('address') is-invalid @enderror"
                                                        required>{{ $siteInfo->address ?? old('address') }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="copyright_text" class="control-label mb-1">Copyright
                                                        Text</label>
                                                    <input id="copyright_text" name="copyright_text" type="text"
                                                        class="form-control @error('copyright_text') is-invalid @enderror"
                                                        value="{{ optional($siteInfo)->copyright_text }}">
                                                    @error('copyright_text')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group has-success">
                                                    <label for="google_map_url" class="control-label mb-1">Google Map
                                                        Url</label>
                                                    <textarea name="google_map_url" id="google_map_url" rows="5"
                                                        class="form-control @error('google_map_url') is-invalid @enderror" required>{{ $siteInfo->google_map_url ?? old('google_map_url') }}</textarea>
                                                    @error('google_map_url')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-9">

                                        </div>
                                        <div class="col-sm-3">
                                            <input id="payment-button" type="submit"
                                                class="btn btn-lg btn-info btn-block"
                                                value="@isset($product) Update @else Submit @endisset">
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

        function logoImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#Logo')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        };


        function FavIcon(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#FavIcon')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
