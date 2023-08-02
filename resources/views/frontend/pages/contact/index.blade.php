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
                            <img src="assets/image/holder/Asset 1-8.png" alt="">
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
        <div class="why_choose section_padding">
            <div class="container">
                <!-- why_choose_wrapper -->
                <div class="why_choose_wrapper">
                    <!-- why_choose_image -->
                    <div class="why_choose_image">
                        <img src="assets/image/holder/banner.png" alt="">
                    </div>
                    <!-- why_choose_content -->
                    <div class="why_choose_content">
                        <!-- section ttile -->
                        <div class="section_title text-start mw-100">
                            <!-- title heading -->
                            <h1 class="section_heading">Why Speacial<span> Classic IT?</span></h1>
                            <!-- section text -->
                            <p class="section_text">We can help you Uplift your Business and Boost your Revenue using Latest
                                Technological Solutions. Instead of feeding unnecessary services and implementations that
                                increases your cost, we provide only just the solution that’s best for your business.</p>
                        </div>
                        <!-- text -->
                        <div class="why_choose_inner">
                            <!-- why_choose_box -->
                            <div class="why_choose_box">
                                <!-- image -->
                                <div class="why_bxchoose_image">
                                    <img src="assets/image/holder/qa.png" alt="">
                                </div>
                                <!-- right -->
                                <div class="why_choose_right">
                                    <p class="why_choose_title">Communication</p>
                                    <p class="why_choose_text">
                                        Effective communication is arguably the number one skill required software.
                                    </p>
                                </div>
                            </div>
                            <!-- why_choose_box -->
                            <div class="why_choose_box">
                                <!-- image -->
                                <div class="why_bxchoose_image">
                                    <img src="assets/image/holder/w3.png" alt="">
                                </div>
                                <!-- right -->
                                <div class="why_choose_right">
                                    <p class="why_choose_title">Experience</p>
                                    <p class="why_choose_text">
                                        We are more experienced that allows creating a finished solution.
                                    </p>
                                </div>
                            </div>
                            <!-- why_choose_box -->
                            <div class="why_choose_box">
                                <!-- image -->
                                <div class="why_bxchoose_image">
                                    <img src="assets/image/holder/project.png" alt="">
                                </div>
                                <!-- right -->
                                <div class="why_choose_right">
                                    <p class="why_choose_title">Safe &amp; Secure</p>
                                    <p class="why_choose_text">
                                        We follow robust data security strategies will protect an organization’s
                                        information.
                                    </p>
                                </div>
                            </div>
                            <!-- why_choose_box -->
                            <div class="why_choose_box">
                                <!-- image -->
                                <div class="why_bxchoose_image">
                                    <img src="assets/image/holder/w1.png" alt="">
                                </div>
                                <!-- right -->
                                <div class="why_choose_right">
                                    <p class="why_choose_title">Passion for Testing</p>
                                    <p class="why_choose_text">
                                        We test regularly can ensure the level of quality that encourages the diligence o
                                        find bugs
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- choose end -->
    </main>
@endsection
@push('js')
@endpush
