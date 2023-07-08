        <!-- our service -->
        <section class="service_section section_padding">
            <div class="container">
                <!-- section title -->
                <div class="section_title">
                    <!-- title heading -->
                    <h1 class="section_heading">Our <span>Service</span></h1>
                    <!-- section text -->
                    <p class="section_text">Get personalized web design and development solutions from us to enhance your
                        personal and business visibility, growth, and engagement, today!</p>
                </div>
                <!-- service wrapper -->
                <div class="serrvice_wrapper">
                    @isset($productCategories)
                        @foreach ($productCategories as $key => $service)

                                <div class="service_item">
                                  <a href="{{route('singleService', $service->slug)}}">
                                      <!-- image -->
                                      <div class="service_item_image">
                                        <img src="{{ asset('assets/images/uploads/category/icon/' . $service->icon) }}"
                                            alt="">
                                    </div>
                                    <!-- heading -->
                                    <h2 class="service_item_heading">{{ $service->name }}</h2>
                                    <!-- text -->
                                    <div class="service_item_text">{!! $service->short_description !!}</div>
                                    <!-- service list -->
                                    <ul class="service_list">
                                        @if ($service->keyFeature)
                                            @foreach ($service->keyFeature as $keyFeature)
                                                <!-- service_list -->
                                                <li class="service_list_item">
                                                    <span class="service_list_icon">
                                                        <i class="fa-regular fa-circle-check"></i>
                                                    </span>
                                                    <span class="service_list_text">{{$keyFeature->title}}</span>
                                                </li>
                                            @endforeach
                                        @endif


                                    </ul>
                                    <!-- service btn -->
                                    <div class="service_btn">
                                        <a href="https://classicit.com.bd/service">View Details <span><i
                                                    class="fa-solid fa-arrow-right"></i></span></a>
                                    </div>
                                  </a>
                                </div>

                        @endforeach

                    @endisset
                    <!-- service item -->
                    {{-- <div class="service_item">
                        <!-- image -->
                        <div class="service_item_image">
                            <img src="assets/image/serv/hard-disk.svg" alt="">
                        </div>
                        <!-- heading -->
                        <h2 class="service_item_heading">Domain & Hosting Service</h2>
                        <!-- text -->
                        <p class="service_item_text">Discover the appropriate domain name and hosting package for your
                            business</p>
                        <!-- service list -->
                        <ul class="service_list">
                            <!-- service_list -->
                            <li class="service_list_item">
                                <span class="service_list_icon">
                                    <img src="assets/image/product/batch.png" alt="">
                                </span>
                                <span class="service_list_text">Affordability</span>
                            </li>
                            <!-- service_list -->
                            <li class="service_list_item">
                                <span class="service_list_icon">
                                    <img src="assets/image/product/batch2.png" alt="">
                                </span>
                                <span class="service_list_text">No Limits</span>
                            </li>
                            <!-- service_list -->
                            <li class="service_list_item">
                                <span class="service_list_icon">
                                    <img src="assets/image/product/batch3.png" alt="">
                                </span>
                                <span class="service_list_text">Optimized Control Panel</span>
                            </li>
                            <!-- service_list -->
                            <li class="service_list_item">
                                <span class="service_list_icon">
                                    <img src="assets/image/product/batch4.png" alt="">
                                </span>
                                <span class="service_list_text">Friendly Support</span>
                            </li>
                            <!-- service_list -->
                            <li class="service_list_item">
                                <span class="service_list_icon">
                                    <img src="assets/image/product/batch8.png" alt="">
                                </span>
                                <span class="service_list_text">Easy to Use</span>
                            </li>
                            <!-- service_list -->
                            <li class="service_list_item">
                                <span class="service_list_icon">
                                    <img src="assets/image/product/batch9.png" alt="">
                                </span>
                                <span class="service_list_text">99.99% Uptime Guarantee</span>
                            </li>
                            <!-- service_list -->
                            <li class="service_list_item">
                                <span class="service_list_icon">
                                    <img src="assets/image/product/batch10.png" alt="">
                                </span>
                                <span class="service_list_text">Safe & Secure</span>
                            </li>
                        </ul>
                        <!-- service btn -->
                        <div class="service_btn">
                            <a href="https://classicit.com.bd/service">View Details <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div> --}}

                </div>
            </div>
        </section>
        <!-- our service end -->
