<div class="why_choose section_padding">
    <div class="container">
        <!-- why_choose_wrapper -->
        <div class="why_choose_wrapper">
            <!-- why_choose_image -->
            <div class="why_choose_image">
                <img src="{{asset('assets/images/chooseusbanner.png')}}" alt="">
            </div>
            <!-- why_choose_content -->
            <div class="why_choose_content">
                <!-- section ttile -->
                <div class="section_title text-start mw-100">
                    <!-- title heading -->
                    <h1 class="section_heading">Why Special<span> Classic IT?</span></h1>
                    <!-- section text -->
                    <p class="section_text">We can help you Uplift your Business and Boost your Revenue using
                        Latest Technological Solutions. Instead of feeding unnecessary services and implementations
                        that increases your cost, we provide only just the solution that’s best for your business.
                    </p>
                </div>
                <!-- text -->
                <div class="why_choose_inner">
                    <!-- why_choose_box -->
                    @isset($whyChooseUsItems)
                    @foreach ($whyChooseUsItems as $key=>$whyChooseUsItem)
                    <div class="why_choose_box">
                        <!-- image -->
                        <div class="why_bxchoose_image">
                            <img src="{{asset('assets/images/uploads/why-choose-us/' . $whyChooseUsItem->icon )}}" alt="">
                        </div>
                        <!-- right -->
                        <div class="why_choose_right">
                            <p class="why_choose_title">{{ $whyChooseUsItem->title}}</p>
                            <p class="why_choose_text">
                                {!! $whyChooseUsItem->short_description !!}
                            </p>
                        </div>
                    </div>

                    @endforeach

                    @endisset

                </div>
            </div>
        </div>
    </div>
</div>
