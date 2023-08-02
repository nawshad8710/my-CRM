@extends('frontend.layouts.app')

@section('title', 'terms & condition')
@push('css')
@endpush

@section('section')
<main class="main">
    <!-- inner banner -->
    <div class="breadcamb section_padding">
        <div class="container">
            <h2 class="breadcamb_title">Terms & Condition</h2>
        </div>
    </div>
    <!-- inner banner end -->
    <div class="section_padding">
        <div class="container">
           {!! optional($termsAndCondition)->long_description !!}

        </div>
    </div>
</main>
@endsection
@push('js')
@endpush
