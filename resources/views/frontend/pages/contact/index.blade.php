@extends('frontend.layouts.app')

@section('title', 'contact Page')
@push('css')
@endpush

@section('section')
    <main class="main">
        <!-- breadcamb -->
        <div class="breadcamb section_padding">
            <div class="container">
                <h2 class="breadcamb_title">Contact Us</h2>
            </div>
        </div>
        <!-- breadcamb end -->

        <!-- contact -->
        <div class="contact">
            <!-- contact details -->
            <div class="contact section_padding">
                <div class="container">
                    <!-- contact  -->
                    <div class="contact_wrapper">
                        <!-- contact image -->
                        <div class="contact_image">
                            <img src="{{asset('assets/images/contactPage.png')}}" alt="">
                        </div>
                        <!-- contatc info -->
                        <div class="contact_form">
                            <!-- main form -->
                            <form action="{{ route('contactPageStore') }}" method="post">
                                @csrf
                                <!-- wrapper -->
                                <div class="form_wrapper">
                                    <!-- form item -->
                                    <div class="form_inner">
                                        <!-- title -->
                                        <label for="">Your Name</label>
                                        <input type="text" name="name" class="input_control">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- form item -->
                                    <div class="form_inner">
                                        <!-- title -->
                                        <label for="">Email Address</label>
                                        <input type="text" name="email" class="input_control">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- form item -->
                                    <div class="form_inner">
                                        <!-- title -->
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" class="input_control">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- form item -->
                                    <div class="form_inner">
                                        <!-- title -->
                                        <label for="">Message</label>
                                        <textarea name="message" class="input_control"></textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- submit btn -->
                                    <div class="submit_btn">
                                        <button class="btn btn_hover" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cotact end -->

        <!-- choose -->
      @include('frontend.components.why-choose-us')
        <!-- choose end -->
    </main>
@endsection
@push('js')
@endpush
