@extends('frontend.layouts.app')

@section('title', 'Classic It')
@push('css')
@endpush

@section('section')
    <!--
            ========================
                main section start
            ========================
             -->
    <main class="main">
        @include('frontend.components.banner')

        @include('frontend.components.achivement')

        @include('frontend.components.service')

        <!-- our product -->
       @include('frontend.components.product')
        <!-- our product end -->

        <!-- testimonial -->
        @include('frontend.components.testimonial')
        <!-- testimonial end -->

        <!-- why choose us -->
       @include('frontend.components.why-choose-us')
        <!-- why choose us end -->

        <!-- our clint section -->
       @include('frontend.components.our-client')
        <!-- our clint section end -->
    </main>
    <!--
            ========================
                main section end
            ========================
             -->
@endsection
@push('js')
@endpush
