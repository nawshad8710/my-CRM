@extends('frontend.layouts.app')

@section('title', $singleProduct->title)
@push('css')
@endpush

@section('section')

    <main class="main">
        <!-- breadcamb -->
        <div class="breadcamb section_padding">
            <div class="container">
                <h2 class="breadcamb_title">
                    {{ $singleProduct->title }}
                </h2>
            </div>
        </div>
        <!-- breadcamb end -->

        <!-- product banner -->
        <div class="product_banner section_padding">
            <div class="container">
                <div class="productp_wrapper">
                    <!-- product content -->
                    <div class="productp_content">
                        <h1 class="section_heading">{{ $singleProduct->title }} Software</h1>
                        <p class="banner_text">ERP (Enterprise Resource Planning) management software is a type of software
                            that helps businesses manage their day-to-day operations more efficiently by integrating various
                            business processes into a single system. It is designed to handle administrative tasks such as
                            inventory management, financial management, human resources management, and customer
                            relationship management.</p>
                        <!-- view plan -->
                        <div class="product_plan_banner">
                            <a href="#pricing_table" class="btn_control common_btn btn_hover d-inline-block">View Plan</a>
                        </div>
                    </div>

                    <!-- product image -->
                    <div class="productp_image">
                        <img src="{{ asset('assets/images/uploads/product/upper-video-thumbnail/' . $singleProduct->upper_video_thumbnail) }}"
                            alt="">
                        <!-- video popup -->
                        <a href="{{ $singleProduct->upper_video_link }}" class="product_video_btn video_popup">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- product banner end -->

        <!-- product feature -->
        <div class="product_feature section_padding">
            <div class="container">
                <!-- section title -->
                <div class="section_title">
                    <!-- title heading -->
                    <h1 class="section_heading">Features Of {{ $singleProduct->title }} Software</h1>
                    <!-- section text -->
                    <p class="section_text">We make the great ERP software program in your enterprise that consists of the
                        competencies for procurement, deliver chain management, inventory, manufacturing, maintenance, order
                        managemen</p>
                </div>
                <!-- product feature wrapper -->
                <div class="product_feature_wrapper">
                    @foreach ($singleProduct->feature as $productFeature)
                        <div class="product_feature_item">
                            <!-- image -->
                            <div class="product_feature_image">
                                <img src="{{ asset('assets/images/uploads/product/feature/' . $productFeature->icon) }}"
                                    alt="">
                            </div>
                            <!-- product_feature_text -->
                            <p class="product_feature_text">{{ $productFeature->title }}</p>
                        </div>
                    @endforeach
                    <!-- item -->


                </div>
            </div>
        </div>
        <!-- product feature end -->

        <!-- feature details -->
        <div class="feature_details section_padding">
            <div class="container">
                <div class="feature_wrapper">
                    <!-- product content -->
                    <div class="productp_content">
                        <h1 class="section_heading">ERP Software Modules</h1>
                        <p class="banner_text">The dashboard is significant piece of any product. To bring all the vital
                            data about your business at the tip of your finger, we make a remarkable dashboard. You can know
                            about the number of products, customers, suppliers. The dashboard will show you product info for
                            every most selling product by a histogram. To compare the sale and purchase there is a line
                            chart. Which can give you a total graphical view about the sale and purchase ratio monthly?</p>
                        <!-- view plan -->
                        <div class="product_plan_banner">
                            <a href="#pricing_table" class="btn_control common_btn btn_hover d-inline-block">View Plan</a>
                        </div>
                    </div>

                    <!-- product image -->
                    <div class="productp_image">
                        <img src="{{ asset('assets/images/uploads/product/lower-video-thumbnail/' . $singleProduct->lower_video_thumbnail) }}"
                            alt="">
                        <!-- video popup -->
                        <a href="{{ $singleProduct->lower_video_link }}" class="product_video_btn video_popup">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- feature details end -->

        <!-- product price -->
        <div class="product_pricing section_padding" id="pricing_table">
            <div class="container">
                <!-- section title -->
                <div class="section_title">
                    <!-- title heading -->
                    <h1 class="section_heading">Software Pricing</h1>
                    <!-- section text -->
                    <p class="section_text">A point of sale allows making your enterprise bills faster. The worker as soon
                        as selects the goods in step with the client's wishes to shop and the gadget mechanically calculates
                        the price</p>
                </div>
                <!-- pricing table wrapper -->
                <div class="pricing_table_heading">
                    <!-- pricing -->
                    <table class="table_pricing">
                        <thead>
                            <tr style="background: unset;">
                                <th>
                                    Service
                                </th>
                                <th>
                                    BASIC
                                    <div class="priceheading_main">
                                        <p>200$</p>
                                        <!--<span>$</span>-->
                                    </div>
                                </th>
                                <th>
                                    ADVANCED
                                    <div class="priceheading_main">
                                        <p>350$</p>
                                        <!--<span>$</span>-->
                                    </div>
                                </th>
                                <th>
                                    PRO
                                    <div class="priceheading_main">
                                        <p>500$</p>
                                        <!--<span>$</span>-->
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- table body -->
                        <tbody>
                            <!-- table item -->
                            <tr>
                                <td>
                                    <p class="pricint_table_title">Life Time Update</p>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-xmark"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- table item -->
                            <tr>
                                <td>
                                    <p class="pricint_table_title">6 Months Support</p>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        Unlimited
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        Unlimited
                                    </div>
                                </td>
                            </tr>
                            <!-- table item -->
                            <tr>
                                <td>
                                    <p class="pricint_table_title">Permitted for one domain</p>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- table item -->
                            <tr>
                                <td>
                                    <p class="pricint_table_title">For personal project</p>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-xmark"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- table item -->
                            <tr>
                                <td>
                                    <p class="pricint_table_title">Email Support</p>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-xmark"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- table item -->
                            <tr>
                                <td>
                                    <p class="pricint_table_title">
                                        Skype Support</p>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-xmark"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- table item -->
                            <tr>
                                <td>
                                    <p class="pricint_table_title">Anydesk Support</p>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-xmark"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- table item -->
                            <tr>
                                <td>
                                    <p class="pricint_table_title">Whatsapp Support</p>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- table item -->
                            <tr>
                                <td>
                                    <p class="pricint_table_title">Free Installation cpanel</p>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="pricing_check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- get package -->
                            <tr>
                                <td></td>
                                <td>
                                    <div class="get_package_btn">
                                        <a href="{{route('contactPage')}}">Get Package</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="get_package_btn">
                                        <a href="{{route('contactPage')}}">Get Package</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="get_package_btn">
                                        <a href="{{route('contactPage')}}">Get Package</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- product price end -->

        <!-- our product -->
        @include('frontend.components.creative-product')
        <!-- our product end -->
    </main>



@endsection
@push('js')
@endpush
