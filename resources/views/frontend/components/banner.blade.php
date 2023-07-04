 <!-- banner sarction -->
 <section class="banner_section">
     <div class="container">
         <!-- banner wrapper -->
         <div class="banner_wrapper">
             <!-- banner_content -->
             <div class="banner_content">
                 <!-- banner toptitle -->
                 <p class="banner_toptitle" data-aos="fade-up">Software Company</p>
                 <!-- banner heading -->
                 <h1 class="banner_heading" data-aos="fade-up">{{ optional($banner)->heading }}
                     <span class="banner_headingsubf" id="element"></span>
                 </h1>
                 {{-- <h1 class="banner_heading" data-aos="fade-up">We can Grow your Business<br>Service Provide
                    <span class="banner_headingsubf" id="element"></span>
                </h1> --}}
                 <!-- banner text -->
                 <p class="banner_text" data-aos="fade-left">
                     {{ optional($banner)->short_description }}
                 </p>
                 {{-- <p class="banner_text" data-aos="fade-left">
                    Applying cutting-edge technology to power digital transformation. We specialize in converting
                    the Vision of your website into Reality. Welcome to Classic IT.
                </p> --}}

                 <!-- banner service -->
                 <div class="banner_service">
                     <!-- wrapper -->
                     <div class="banner_service_wrapper" data-aos="fade-right">
                         <!-- item -->
                         <div class="banner_service_item">
                             <!-- image -->
                             <div class="banner_service_image">
                                 <img src="assets/image/service/2d3d.png" alt="">
                             </div>
                             <!-- content -->
                             <div class="banner_service_content">
                                 <h1 class="banner_service_heading">Software</h1>
                             </div>
                         </div>

                         <!-- item -->
                         <div class="banner_service_item">
                             <!-- image -->
                             <div class="banner_service_image">
                                 <img src="assets/image/service/softdev.png" alt="">
                             </div>
                             <!-- content -->
                             <div class="banner_service_content">
                                 <h1 class="banner_service_heading">Solutions</h1>
                             </div>
                         </div>

                         <!-- item -->
                         <div class="banner_service_item">
                             <!-- image -->
                             <div class="banner_service_image">
                                 <img src="assets/image/service/digital.png" alt="">
                             </div>
                             <!-- content -->
                             <div class="banner_service_content">
                                 <h1 class="banner_service_heading">Marketing</h1>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- banner_thumbnail -->
             <div class="banner_thumbnail" data-aos="fade-left">
                 <!-- image -->
                 <img src="{{asset('assets/images/uploads/banner/' . $banner->image)}}" alt="">
             </div>
         </div>
     </div>
 </section>
 <!-- banner sarction end -->
