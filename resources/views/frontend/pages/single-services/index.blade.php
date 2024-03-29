@extends('frontend.layouts.app')

@section('title', $singleService->name)
@push('css')
@endpush

@section('section')
    <main class="main">
        <!-- inner banner -->
        <section class="inner_banner software_innerbanner section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-7 col-sm-9">
                        <div class="inner_banner_content text-center">
                            <h2 class="text-white inner_banner_heading">{{ $singleService->name }}</h2>
                            <div class="text-white inner_banner_text">
                                {!! $singleService->short_description !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- inner banner end -->

        <!-- details section -->
        <section class="details_section section_padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="details_thumb">
                            <img src="assets/image/devlopement.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="details_content">
                            <h1 class="section_heading">Create Digital Products</h1>
                            <div class="section_text">{!! $singleService->long_description !!}</div>
                            <!-- list -->
                            <ul>
                                @if ($singleService->keyFeature)
                                    @foreach ($singleService->keyFeature as $key=>$keyFeature)
                                    <li>
                                        <span class="details_icon"><i class="fa-solid fa-check"></i></span>
                                        <span>{{$keyFeature->title}}</span>
                                    </li>
                                    @endforeach
                                @endif


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- details section end -->

        <!-- web design service -->
        <section class="section_padding">
            <div class="container">
                <!-- section title -->
                <div class="section_title">
                    <!-- title heading -->
                    <h1 class="section_heading">Build Up Custom Software</h1>
                    <!-- section text -->
                    <p class="section_text">Get personalized web design and development solutions from us to enhance your
                        personal and business visibility, growth, and engagement, today!</p>
                </div>
                <!-- service card -->
                <div class="row gy-4">
                    @if ($singleServiceProducts)
                        @foreach ($singleServiceProducts as $singleProduct)
                            <!-- single column -->
                            <div class="col-sm-6 col-lg-4">
                               <a href="{{route('singleProduct', $singleProduct->slug)}}">
                                <div class="card_service text-center">
                                    <div class="card_service_image mx-auto">
                                        <img src="{{asset('assets/images/uploads/product/icon/'. $singleProduct->icon)}}" alt="">
                                    </div>
                                    <h3 class="card_service_title">{{$singleProduct->title}}</h3>
                                    <p class="card_service_text">{!! $singleProduct->short_description !!}</p>
                                </div>
                               </a>
                            </div>
                        @endforeach
                    @endif


                    <!-- single column -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="card_service d-flex justify-content-center text-center flex-column">
                            <h3 class="card_service_title">IT Consulting Support</h3>
                            <div class="servicecard_btn">
                                <a href="">Submit Request</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- web design service end -->

        <!-- industry weserve -->
        <div class="indus_service section_padding">
            <div class="container">
                <!-- section title -->
                <div class="section_title">
                    <!-- title heading -->
                    <h1 class="section_heading">Industry We Serve</h1>
                    <!-- section text -->
                    <p class="section_text">Get personalized web design and development solutions from us to enhance your
                        personal and business visibility, growth, and engagement, today!</p>
                </div>
                <!-- wrapper -->
                <div class="indus_service_wrapper">
                    @if ($industryServeGlobal)
                        @foreach ($industryServeGlobal as $industryServe)
                            <!-- item -->
                            <div class="indus_service_item">
                                <img src="{{ asset('assets/images/uploads/industry-serve/' . $industryServe->icon) }}"
                                    alt="">
                                <p>{{ $industryServe->title }}</p>
                            </div>
                            <!-- item -->
                        @endforeach
                    @endif


                </div>
            </div>
        </div>
        <!-- industry weserve end -->

        <!-- technology -->
        <section class="section_padding">
            <div class="container">
                <!-- section title -->
                <div class="section_title">
                    @if (count($singleServiceTechnology) > 0)
                    <h1 class="section_heading">We Use Technology</h1>
                    @endif
                    <!-- title heading -->

                </div>
                <!-- row -->
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 gy-4">

                    @if ($singleServiceTechnology)
                    @foreach ($singleServiceTechnology as $key => $technology)
                    <div class="col">
                        <div class="tech_card text-center">
                            <div class="tech_image">
                                <img src="{{asset('assets/images/uploads/technology/' .$technology->icon)}}" alt="">
                            </div>
                            <p class="tech_name">{{$technology->title}}</p>
                        </div>
                    </div>
                    @endforeach

                    @endif




                </div>
            </div>
        </section>
        <!-- technology end -->

    </main>
@endsection
@push('js')
@endpush
