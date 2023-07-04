<section class="testimonial section_padding">
    <div class="container">
        <!-- section title -->
        <div class="section_title">
            <!-- title heading -->
            <h1 class="section_heading">Our<span> Testimonials</span></h1>
        </div>
        <!-- testimonial slider -->
        <div class="testimonial_slider">
            <!-- testimonial item -->
            @isset($testimonials)
                @foreach ($testimonials as $key=>$testimonial)
                <div class="testimonial_item">
                    <!-- author -->
                    <div class="testimonial_author">
                        <!-- image -->
                        <div class="testm_authorimg">
                            <img src="{{asset('assets/images/uploads/testimonial/' . $testimonial->image)}}" style="width: 50px; height:50px; border-radius: 50px" alt="image">
                        </div>
                        <!-- author info -->
                        <div class="testm_authorinfo">
                            <p class="testm_author_name">{{$testimonial->name}}</p>
                            <p class="testm_author_desgint">{{$testimonial->designation}}</p>
                        </div>
                    </div>
                    <!-- text body -->
                    <div class="testimonial_body">
                        <p class="tesitinonial_text">
                            {!! $testimonial->short_description!!}
                        </p>
                    </div>
                </div>
                @endforeach
            @endisset

            <!-- testimonial item -->

        </div>
    </div>
</section>
