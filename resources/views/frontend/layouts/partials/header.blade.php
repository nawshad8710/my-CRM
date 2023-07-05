<header class="header_section">
    <!-- container -->
    <div class="container">
        <!-- headre wrapper -->
        <div class="header_wrapper">
            <!-- logo -->
            <div class="logo_inner">
                <!-- logo image -->
                <a href="https://classicit.com.bd" class="logo_image">
                    <img src="{{ asset('assets/images/uploads/site-info/logo/' . $siteInfo->logo) }}" alt="">
                </a>
            </div>
            <!-- headre right -->
            <div class="header_right">
                <!-- header nav -->
                <nav class="header_nav">
                    <!-- header nav list -->
                    <ul class="header_navList">
                        <!-- header_nav_item -->
                        <li class="header_nav_item">
                            <!-- header_nav_link -->
                            <a href="https://classicit.com.bd" class="header_nav_link">Home</a>
                        </li>
                        <!-- header_nav_item -->
                        <li class="header_nav_item About_nav_item">
                            <!-- header_nav_link -->
                            <a href="#" class="header_nav_link">
                                About
                                <!-- header collape icon -->
                                <span class="header_collape_icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6.147"
                                        viewBox="0 0 12 6.147">
                                        <path class="cx_1630815321671_svg_icons"
                                            d="M16.749,8.165a.857.857,0,0,0-1.212,0L11.606,12.1a.875.875,0,0,1-1.212,0L6.463,8.165A.857.857,0,1,0,5.251,9.377l3.93,3.931a2.571,2.571,0,0,0,3.637,0l3.931-3.931A.857.857,0,0,0,16.749,8.165Z"
                                            transform="translate(-5 -7.914)" fill="#1E272E"></path>
                                    </svg>
                                </span>
                            </a>
                            <!-- short nav -->
                            <div class="short_nav">
                                <ul class="short_nav_list">
                                    <li class="short_nav_item">
                                        <a href="./about" class="short_nav_link">Our Company</a>
                                    </li>
                                    <li class="short_nav_item">
                                        <a href="./team" class="short_nav_link">Our Team</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- header_nav_item -->
                        <li class="header_nav_item">
                            <!-- header_nav_link -->
                            <a href="#" class="header_nav_link">
                                Products
                                <!-- header collape icon -->
                                <span class="header_collape_icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6.147"
                                        viewBox="0 0 12 6.147">
                                        <path class="cx_1630815321671_svg_icons"
                                            d="M16.749,8.165a.857.857,0,0,0-1.212,0L11.606,12.1a.875.875,0,0,1-1.212,0L6.463,8.165A.857.857,0,1,0,5.251,9.377l3.93,3.931a2.571,2.571,0,0,0,3.637,0l3.931-3.931A.857.857,0,0,0,16.749,8.165Z"
                                            transform="translate(-5 -7.914)" fill="#1E272E"></path>
                                    </svg>
                                </span>
                            </a>
                            <!-- header sub nav -->
                            <div class="header_sub_nav">
                                <!-- subnav_list -->
                                <div class="subnav_list">

                                @if ($products)
                                @foreach ($products ?? [] as $product)
                                <!-- subnav_list_item -->
                                <div class="subnav_list_item">
                                    <!-- subnavlist_link -->
                                    <a href="{{route('singleProduct', $product->slug)}}" class="subnavlist_link">
                                        <!-- subnav image -->
                                        <div class="subnav_image">
                                            <img src="assets/image/service/school_management.png"
                                                alt="">
                                        </div>
                                        <!-- subnav content -->
                                        <div class="subnav_content">
                                            <!-- title -->
                                            <h1 class="subnav_content_title">{{$product->title}}</h1>
                                            <!-- text -->
                                            {{-- <p class="subnav_content_text">
                                                School Management System Is Best
                                            </p> --}}
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                                @endif



                                </div>
                            </div>
                        </li>
                        <!-- header_nav_item -->
                        <li class="header_nav_item">
                            <!-- header_nav_link -->
                            <a href="#" class="header_nav_link">
                                Service
                                <!-- header collape icon -->
                                <span class="header_collape_icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6.147"
                                        viewBox="0 0 12 6.147">
                                        <path class="cx_1630815321671_svg_icons"
                                            d="M16.749,8.165a.857.857,0,0,0-1.212,0L11.606,12.1a.875.875,0,0,1-1.212,0L6.463,8.165A.857.857,0,1,0,5.251,9.377l3.93,3.931a2.571,2.571,0,0,0,3.637,0l3.931-3.931A.857.857,0,0,0,16.749,8.165Z"
                                            transform="translate(-5 -7.914)" fill="#1E272E"></path>
                                    </svg>
                                </span>
                            </a>
                            <!-- header sub nav -->
                            <div class="header_sub_nav sub_nav_service">
                                <!-- subnav_list -->
                                <div class="subnav_list">
                                    @if($productCategories)
                                    @foreach ($productCategories ?? [] as $category)
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="{{route('singleService',$category->slug)}}" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/web.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">{{$category->name}}</h1>
                                                <!-- text -->
                                                {{-- <p class="subnav_content_text">
                                                    Web Design And Development
                                                </p> --}}
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                    @endif
                                    <!-- subnav_list_item -->


                                </div>
                            </div>
                        </li>
                        <!-- header_nav_item -->
                        <li class="header_nav_item">
                            <!-- header_nav_link -->
                            <a href="{{route('contactPage')}}" class="header_nav_link">Contact</a>
                        </li>
                    </ul>
                </nav>
                <!-- header btn -->
                <div class="header_btn">
                    <!-- global btn -->
                    <a href="{{route('contactPage')}}" class="btn_control common_btn btn_hover">Hire Us</a>
                </div>
            </div>
            <!-- mobile toggle -->
            <div class="toggle_nav" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>

        <!-- mobile nav -->
        <div class="mobile_nav offcanvas offcanvas-start" id="offcanvasExample">
            <div class="mobile_navcontent">
                <!-- mobile nav -->
                <div class="mobileNav">
                    <!-- logo -->
                    <div class="logo_inner">
                        <!-- logo image -->
                        <a href="./index" class="logo_image">
                            <img src="assets/image/logo.png" alt="">
                        </a>
                    </div>
                    <!-- list -->
                    <ul class="mobile_navlist">
                        <li>
                            <a href="./index">Home</a>
                        </li>
                        <li>
                            <a href="./about">About</a>
                        </li>
                        <li>
                            <a href="./team">Our Team</a>
                        </li>
                        <li class="mobile_product">
                            <a href="#">Products <span><svg xmlns="http://www.w3.org/2000/svg" width="12"
                                        height="6.147" viewBox="0 0 12 6.147">
                                        <path class="cx_1630815321671_svg_icons"
                                            d="M16.749,8.165a.857.857,0,0,0-1.212,0L11.606,12.1a.875.875,0,0,1-1.212,0L6.463,8.165A.857.857,0,1,0,5.251,9.377l3.93,3.931a2.571,2.571,0,0,0,3.637,0l3.931-3.931A.857.857,0,0,0,16.749,8.165Z"
                                            transform="translate(-5 -7.914)" fill="#1E272E"></path>
                                    </svg></span></a>
                            <!-- mobile product list -->
                            <div class="mobile_product_list">
                                <div class="mobile_subnav_list">
                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./school.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/school_management.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">School Management System</h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    consectetur adipisicing elit Sunt.
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./singleproduct" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/erp.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">POS Management</h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    consectetur adipisicing elit Sunt.
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./erp.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/publication/bill.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">ERP Management </h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    Find the Perfect ERP for You
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./tailor.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/softdev.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">Tailor Management
                                                </h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    Tailor Management Our You
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./corior.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/softdev.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">
                                                    Courier Management
                                                </h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    It is designed to handle You
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./ecommarce.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/e-commerce.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">E-commarce Website</h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    consectetur adipisicing elit Sunt.
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./pharmecy.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/user-interface.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">Pharmacy Software</h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    Pharmacy software is type medical
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <!-- service -->
                        <li class="mobile_producttwo">
                            <a href="#">Service <span><svg xmlns="http://www.w3.org/2000/svg" width="12"
                                        height="6.147" viewBox="0 0 12 6.147">
                                        <path class="cx_1630815321671_svg_icons"
                                            d="M16.749,8.165a.857.857,0,0,0-1.212,0L11.606,12.1a.875.875,0,0,1-1.212,0L6.463,8.165A.857.857,0,1,0,5.251,9.377l3.93,3.931a2.571,2.571,0,0,0,3.637,0l3.931-3.931A.857.857,0,0,0,16.749,8.165Z"
                                            transform="translate(-5 -7.914)" fill="#1E272E"></path>
                                    </svg></span></a>
                            <!-- mobile product list -->
                            <div class="mobile_product_listtwo">
                                <div class="mobile_subnav_list">
                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./webdesign.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/web.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">
                                                    Web Design And Development
                                                </h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    Web Design And Development
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./softwaredeve.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/softdev.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">
                                                    Software Development
                                                </h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    Software Development
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./domainhost.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/serv/hard-disk.svg" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">
                                                    Domain And Hosting
                                                </h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    Domain And Hosting
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./uiux.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/serv/device.svg" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">
                                                    UI/UX Design
                                                </h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    UI/UX Design
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./graphicsdesign.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/graphic-designer.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">
                                                    Graphic Design
                                                </h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    Graphic Design
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- subnav_list_item -->
                                    <div class="subnav_list_item">
                                        <!-- subnavlist_link -->
                                        <a href="./digitalmarketing.html" class="subnavlist_link">
                                            <!-- subnav image -->
                                            <div class="subnav_image">
                                                <img src="assets/image/service/digital.png" alt="">
                                            </div>
                                            <!-- subnav content -->
                                            <div class="subnav_content">
                                                <!-- title -->
                                                <h1 class="subnav_content_title">
                                                    Digital Marketing
                                                </h1>
                                                <!-- text -->
                                                <p class="subnav_content_text">
                                                    Digital Marketing
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="{{route('contactPage')}}">Contact</a>
                        </li>

                        <div class="header_btn">
                            <!-- global btn -->
                            <a href="./contact" class="btn_control common_btn btn_hover">Hire Us</a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
