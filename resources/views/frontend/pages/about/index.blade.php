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
                        <p class="section_text mb-3">
                            Classic IT is a provider of IT consulting and software development services. We have helped non-IT organizations and software product companies improve business performance and quickly win new customers
                        </p>
                        <p class="section_text mb-3">
                            Classic IT is a leading software development company delivering tailor-made digital solutions to businesses worldwide. As a technology pioneer with deep knowledge and expertise Classic IT believes in helping companies overcome their most complex tech challenges and drive business growth.
                        </p>
                        <p class="section_text">
                            Classic IT offers custom software development and IT services. Our developers createcustomized software for individuals, start-ups, and small and medium-sized businesses. Based on years of experience, we know that each business has a different software and hardware environment. That is why we provide a wide range of software development services, as well as meet the needs and requirements of customers for the most modern technologies.
                        </p>
                    </div>
                    <div class="product_details_btn">
                        <a href="#" class="btn_control common_btn btn_hover d-inline-block">Contact Us</a>
                    </div>
                </div>

                <!-- about image -->
                <div class="about_image">
                    <img src="{{asset('assets/images/about/aboutbanner.png')}}" alt="">
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
                        <p class="section_text mb-3">
                            Our motto, ‘You Seed It: We Grow It,’ reflects our business philosophy. From putting flesh on your idea to delivering the expected end new technologies, untangle complex issues that always emerge during digital evolution, and orchestrate ongoing innovation. We're not just a resource provider. We value our customers' success as much as our own – sharing development risk so that they can be bold in their adoption of new technologies.
                        </p>
                    </div>
                    <!-- vission content card -->
                    <div class="vission_card">
                        <!-- image -->
                        <div class="vission_card_image">
                            <img src="{{asset('assets/images/about/chart.svg')}}" alt="">
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
                    <img src="{{asset('assets/images/about/vission.svg')}}" alt="">
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
                        <p class="section_text mb-3">
                            We’re the mirror of your vision.
                                Classic IT & Sky Mart Ltd. is a global provider of full-spectrum software services, Classic IT & Sky Mart Ltd.
                                Our belief in creating tangible value for our customers is what we think is different about Classic IT. Our attention to detail and quality is unmatched in the industry. We enable progressive businesses to transform, scale, and gain competitive advantage, through the expert delivery of innovative, tailor-made software. Our elegant, data-driven solutions help organizations and people around the world to perform more effectively and achieve better outcomes.
                        </p>
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
