@extends('admin.layouts.app')

@section('title', 'Social Link Form')

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
                                            <h3 class="text-center title-2">@isset($socialLink) Update @else Add New @endisset Social Link</h3>
                                        </div>
                                        <hr>
                                        <form action="@isset($socialLink){{ route('admin.social-link.update', $socialLink->id) }}@else{{ route('admin.social-link.store') }}@endisset" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="url" class="control-label mb-1">Url</label>
                                                        <input id="url" name="url" type="text" class="form-control @error('url') is-invalid @enderror" value="{{ $socialLink->url ?? old('url') }}" required>
                                                        @error('url')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="background_color" class="control-label mb-1">Background Color</label>
                                                        <input id="background_color" name="background_color" type="color" class="form-control @error('background_color') is-invalid @enderror" value="{{ $socialLink->background_color ?? old('background_color') }}" >
                                                        @error('background_color')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="icon" class="control-label mb-1">Icon Code</label>
                                                        <input id="icon" name="icon" type="text" class="form-control @error('icon') is-invalid @enderror" value="{{ $socialLink->icon ?? old('icon') }}" >
                                                        @error('icon')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="foreground_color" class="control-label mb-1">Foreground Color</label>
                                                        <input id="foreground_color" name="foreground_color" type="color" class="form-control @error('foreground_color') is-invalid @enderror" value="{{ $socialLink->foreground_color ?? old('foreground_color') }}" >
                                                        @error('foreground_color')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group has-success">
                                                <label for="short_description" class="control-label mb-1">Short Description</label>
                                                <textarea name="short_description" id="short_description" rows="5" class="form-control @error('short_description') is-invalid @enderror">{{ $service->short_description ?? old('short_description') }}</textarea>
                                                @error('short_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="long_description" class="control-label mb-1">Long Description</label>
                                                <textarea name="long_description" id="long_description" rows="5" class="form-control @error('long_description') is-invalid @enderror">{{ $service->long_description ?? old('long_description') }}</textarea>
                                                @error('long_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div> --}}

                                            <div class="row">
                                                <div class="col-sm-9">

                                                </div>
                                                <div class="col-sm-3">
                                                    <input id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" value="@isset($socialLink) Update @else Submit @endisset">
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
