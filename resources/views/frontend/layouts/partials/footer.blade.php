 <footer class="footer_section">
     <!-- more address -->
     <div class="section_padding">
         <div class="container">
             <div class="row gy-4">
                 <div class="col-12">
                     <div class="location_content">
                         <h2 class="location_heading">Want to <br> know more about us??</h2>
                     </div>
                 </div>
                 <!-- loctation -->
                 <div class="col-md-4">
                     <div class="location_content">
                         <h1 class="location_title">Bangladesh Office</h1>
                         <p class="location_info mb-4">
                             <a href="#"> {{ $siteInfo->address }} </a>
                         </p>
                         <div class="location_info">
                             <p><a href="tel:+8801978159172>" target="blank">Mobile: {{ $siteInfo->phone }}</a></p>
                             <p><a href="mailto:business@opediatech.com"> {{ $siteInfo->email }}</a></p>
                         </div>
                     </div>
                 </div>
                 <!-- loctation -->
                 <div class="col-md-4">
                     <div class="location_content">
                         <h1 class="location_title">Dubai Office</h1>
                         <p class="location_info mb-4">
                             <a href="#"> F-205, Hamda Building-1, <br> Ayal Naser, <br> Deira Dubai, UAE </a>
                         </p>
                         <div class="location_info">
                             <p><a href="tel:+8801978159172>" target="blank">Mobile: +971 50 866 2919</a></p>
                             <p><a href="mailto:business@opediatech.com">dubai@classicit.com.bd</a></p>
                         </div>
                     </div>
                 </div>
                 <!-- loctation -->
                 <div class="col-md-4">
                     <div class="location_content">
                         <h1 class="location_title">Company</h1>
                         <div class="location_info">
                             <p><a href="{{route('termsCondition')}}">Terms & Condition</a></p>
                             <p><a href="{{route('privacyPolicy')}}">Privacy Policy</a></p>
                             <p><a href="{{route('aboutPage')}}">About Us</a></p>
                             <p><a href="{{route('ourTeam')}}">Our Team</a></p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- more address end -->
     <!-- scocket -->
     <div class="container">
         <!-- socket -->
         <div class="socket">
             <!-- wrapper -->
             <div class="socket_wrapper">
                 <p class="socket_text"> Copyright © <span id="socket_year">2020</span>.
                     <a>{{ $siteInfo->copyright_text }}</a> all
                     right reserved </p>
                 <!-- social -->
                 <div class="social">
                     <ul>
                         {{-- @dd($socialLinks) --}}
                         @isset($socialLinks)
                             @foreach ($socialLinks as $key => $socialLink)
                                 <li>
                                     <a href="{{ $socialLink->url }}" target="_blank"><i
                                             class="{{$socialLink->icon}}"></i></a>
                                 </li>
                             @endforeach
                         @endisset


                     </ul>
                 </div>
             </div>
         </div>
         <!-- scrolling top -->
         <div class="sroll_top">
             <i class="fa-solid fa-arrow-up"></i>
         </div>
         <!-- scrolling top end -->
     </div>
 </footer>
