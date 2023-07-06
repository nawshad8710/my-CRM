<section class="our_product section_padding">
    <div class="container">
        <!-- section title -->
        <div class="section_title">
            <!-- title heading -->
            <h1 class="section_heading">Our Creative<span> Products</span></h1>
            <!-- section text -->
            <!--<p class="section_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium voluptates provident animi debitis commodi dolor eligendi reprehenderit quos, quas veritatis quaerat quis laborum</p>-->
        </div>
        <!-- our product wrapper-->
        <div class="our_product_wrapper">
            <!-- product tabs -->
            <div class="nav nav-pills product_tabs" id="v-pills-tab">
                <!-- tab item -->
                {{-- <button class="nav-link active" id="school_management" data-bs-toggle="pill"
                    data-bs-target="#school" type="button">School Management</button> --}}
                <!-- tab item -->
                @if ($products)
                    @foreach ($products as $key => $product)
                        <button class="nav-link {{ $key == 0 ? 'active' : '' }}" data-bs-toggle="pill"
                            data-bs-target="#{{ $product->slug }}" type="button">{{ $product->title }}</button>
                    @endforeach
                @endif


            </div>

            <!-- view -->
            <div class="product_content tab-content" id="v-pills-tabContent">
                <!-- block -->
                {{-- <div class="tab-pane fade active show" id="school">
                    <!-- product main -->
                    <div class="product_wrapper">
                        <!-- product_details -->
                        <div class="product_details">
                            <h2 class="service_item_heading service_item_sofh">School Management Software</h2>
                            <p class="service_item_text">School management software is a type of software that
                                helps educational institutions manage their day-to-day operations more efficiently.
                                It is designed to handle administrative tasks such as student enrollment, attendance
                                tracking, grading, scheduling, and billing.</p>
                            <ul class="service_list">
                                <!-- service_list -->
                                <li class="service_list_item">
                                    <span class="service_list_icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                    <span class="service_list_text">Students Portal</span>
                                </li>
                                <!-- service_list -->
                                <li class="service_list_item">
                                    <span class="service_list_icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                    <span class="service_list_text">Parents Portal</span>
                                </li>
                                <!-- service_list -->
                                <li class="service_list_item">
                                    <span class="service_list_icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                    <span class="service_list_text">Examination & Assessments</span>
                                </li>
                                <!-- service_list -->
                                <li class="service_list_item">
                                    <span class="service_list_icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                    <span class="service_list_text">SMS & Email Messaging</span>
                                </li>
                                <!-- service_list -->
                                <li class="service_list_item">
                                    <span class="service_list_icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                    <span class="service_list_text">Class Attendance</span>
                                </li>
                                <!-- service_list -->
                                <li class="service_list_item">
                                    <span class="service_list_icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                    <span class="service_list_text">Teachers Portal
                                    </span>
                                </li>
                                <!-- service_list -->
                                <li class="service_list_item">
                                    <span class="service_list_icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                    <span class="service_list_text">Invoice & Receipts </span>
                                </li>
                                <!-- service_list -->
                                <li class="service_list_item">
                                    <span class="service_list_icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                    <span class="service_list_text">School Schedules & Calendar</span>
                                </li>
                                <!-- service_list -->
                                <li class="service_list_item">
                                    <span class="service_list_icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                    <span class="service_list_text">Online Payments</span>
                                </li>
                            </ul>
                            <!-- product details btn -->
                            <div class="product_details_btn">
                                <a href="./school" class="btn_control common_btn btn_hover d-inline-block">Know
                                    Details</a>
                            </div>
                        </div>
                        <!-- thumb -->
                        <div class="product_thumb">
                            <img src="assets/image/product/4.png" alt="">
                        </div>
                    </div>
                </div> --}}
                @if ($products)
                    @foreach ($products as $key => $product)
                        <!-- block -->
                        <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}"
                            id="{{ $product->slug }}">
                            <!-- product main -->
                            <div class="product_wrapper">
                                <!-- product_details -->
                                <div class="product_details">
                                    <h2 class="service_item_heading service_item_sofh">{{ $product->title }}</h2>
                                    <p class="service_item_text">{!! $product->short_description !!}
                                    </p>
                                    <ul class="service_list">
                                        @foreach ($product->keyFeature as $keyFeature)
                                            <!-- service_list -->
                                            <li class="service_list_item">
                                                <span class="service_list_icon">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                </span>
                                                <span class="service_list_text">{{$keyFeature->title}}</span>
                                            </li>
                                        @endforeach


                                    </ul>
                                    <!-- product details btn -->
                                    <div class="product_details_btn">
                                        <a href="{{route('singleProduct',$product->slug )}}"
                                            class="btn_control common_btn btn_hover d-inline-block">Know
                                            Details</a>
                                    </div>
                                </div>
                                <!-- thumb -->
                                <div class="product_thumb">
                                    <img src="assets/image/product/pharmecy1.png" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif



            </div>
        </div>
    </div>
</section>
