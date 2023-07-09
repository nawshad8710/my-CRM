@extends('frontend.layouts.app')

@section('title', 'About')
@push('css')
@endpush

@section('section')

<main class="main">
    <!-- breadcamb -->
    <div class="breadcamb section_padding">
        <div class="container">
            <h2 class="breadcamb_title">About us</h2>
        </div>
    </div>
    <!-- breadcamb end -->

    <!-- about -->
    <div class="about section_padding">
        <div class="container">
            <!-- about wrapper -->
            <div class="about_wrapper">
                <!-- about content -->
                <div class="about_content">
                    <!-- section title -->
                    <div class="section_title m-0 text-start mw-100">
                        <!-- title heading -->
                        <h1 class="section_heading">Who We<span> Are?</span></h1>
                        <!-- section text -->
                       {!! $whoWeAre->description !!}
                    </div>
                    <div class="product_details_btn">
                        <a href="{{route('aboutPage')}}" class="btn_control common_btn btn_hover d-inline-block">Contact Us</a>
                    </div>
                </div>

                <!-- about image -->
                <div class="about_image">
                    <img src="{{asset('assets/images/uploads/about/who-we-are/' . $whoWeAre->image)}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- about end -->

    <!-- our_vission -->
    <div class="our_vission section_padding">
        <div class="container">
            <!-- about wrapper -->
            <div class="about_wrapper our_vission_wrapper">
                <!-- about content -->
                <div class="about_content">
                    <!-- section title -->
                    <div class="section_title text-start mw-100">
                        <!-- title heading -->
                        <h1 class="section_heading">Our<span> Vision</span></h1>
                        <!-- section text -->
                        <div class="section_text mb-3">
                           {!! $ourVision->description !!}
                        </div>
                    </div>
                    <!-- vission content card -->
                    <div class="vission_card">
                        <!-- image -->
                        <div class="vission_card_image">
                            <img src="{{asset('assets/images/uploads/about/our-vision/' . $ourVision->image)}}" alt="">
                        </div>
                        <!-- content -->
                        <div class="vission_card_content">
                            <h2 class="vission_card_title">We reiterate our vision</h2>
                            <p class="vission_card_text">
                                We reiterate our vision vividly as we welcome a new member to our family, so the new person has the chance to share a common interest.
                            </p>
                        </div>
                    </div>
                    <!-- vission content card -->
                    <div class="vission_card">
                        <!-- image -->
                        <div class="vission_card_image">
                            <img src="{{asset('assets/images/about/device.svg')}}" alt="">
                        </div>
                        <!-- content -->
                        <div class="vission_card_content">
                            <h2 class="vission_card_title">We envision the world</h2>
                            <p class="vission_card_text">
                                We envision the world of digital marketing as a place for those who look forward to serving others and make a living by honest means.
                            </p>
                        </div>
                    </div>
                    <!-- vission content card -->
                    <div class="vission_card">
                        <!-- image -->
                        <div class="vission_card_image">
                            <img src="{{asset('assets/images/about/hard-disk.svg')}}" alt="">
                        </div>
                        <!-- content -->
                        <div class="vission_card_content">
                            <h2 class="vission_card_title">We are proud that we have</h2>
                            <p class="vission_card_text">
                                We are proud that we have the only mission and one vision that has been a very influential tie with us together towards a common goal, SUCCESS we call it.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- about image -->
                <div class="about_image">
                    <img src="{{asset('assets/images/uploads/about/our-mision/' .$ourMision->image)}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- our_vission end -->

    <!-- our_Mission -->
    <div class="our_Mission section_padding">
        <div class="container">
            <!-- about wrapper -->
            <div class="about_wrapper">
                <!-- about content -->
                <div class="about_content">
                    <!-- section title -->
                    <div class="section_title text-start mw-100">
                        <!-- title heading -->
                        <h1 class="section_heading">Our<span> Mision</span></h1>
                        <!-- section text -->
                        <div class="section_text mb-3">
                          {!! $ourMision->description !!}
                        </div>
                    </div>

                    <!-- vission content card -->
                    <div class="vission_card">
                        <!-- image -->
                        <div class="vission_card_image">
                            <img src="{{asset('assets/images/about/wallet.svg')}}" alt="">
                        </div>
                        <!-- content -->
                        <div class="vission_card_content">
                            <h2 class="vission_card_title">We envision the world</h2>
                            <p class="vission_card_text">
                                We have no regrets admitting that we are not like a large organization that sets dozens of missions to accomplish. We are not engaged in seeking profits all the time. But, we have a very particular mission that, we believe, helps and will aid us in thriving.
                            </p>
                        </div>
                    </div>
                    <!-- vission content card -->
                    <div class="vission_card">
                        <!-- image -->
                        <div class="vission_card_image">
                            <img src="{{asset('assets/images/about/gift.svg')}}" alt="">
                        </div>
                        <!-- content -->
                        <div class="vission_card_content">
                            <h2 class="vission_card_title">We are proud that we have</h2>
                            <p class="vission_card_text">
                                We dream of contributing to the digital marketing landscape as a dynamic world where businesses will start, grow and become a brand that has a supreme focus on improving people’s lives by providing them with value, insights, opportunities, and opportunities.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- about image -->
                <div class="about_image">
                    <img src="{{asset('assets/images/about/banner2.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- our_Mission end -->

    <!-- why choose us -->
    @include('frontend.components.why-choose-us')
    <!-- why choose us end -->

    <!-- our clint section -->
    @include('frontend.components.our-client')
    <!-- our clint section end -->
</main>



@endsection
@push('js')
@endpush
