@extends('frontend.layouts.app')

@section('title', 'Privacy Policy')
@push('css')
@endpush

@section('section')

    <main class="main">
        <!-- inner banner -->
        <div class="breadcamb section_padding">
            <div class="container">
                <h2 class="breadcamb_title">Privacy Policy</h2>
            </div>
        </div>
        <!-- inner banner end -->
        <div class="section_padding">
            <div class="container">
                @isset($privacyPolicy)
                    {!! $privacyPolicy->long_description !!}
                @endisset

            </div>
        </div>
    </main>



@endsection
@push('js')
@endpush
