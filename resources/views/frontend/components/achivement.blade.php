<!-- Our Achievement section -->
<section class="our_achievement section_padding">
    <div class="container">
        <!-- section title -->
        <div class="section_title">
            <!-- title heading -->
            {{-- <h1 class="section_heading">Our <span>Achievement</span></h1> --}}
            <h1 class="section_heading">{{ optional($achive)->title }}</h1>
            <!-- section text -->
            <p class="section_text">{{ optional($achive)->short_description }}</p>
        </div>
        <!-- achievement wrapper -->
        <div class="achievement_wrapper">
            @isset($achiveItems)
                {{-- @if ($achiveItems->length > 0) --}}
                    @foreach ($achiveItems as $key => $achiveitem)
                        <!-- item -->
                        <div class="achievement_item">
                            <!-- image -->
                            <div class="achievement_image">
                                <img src="{{ asset('assets/images/uploads/our-achive/' . $achiveitem->icon) }}"
                                    alt="">
                            </div>
                            <!-- achievement title -->
                            <h2 class="achievement_title">
                                <span>{{ $achiveitem->title }}</span>
                                <span><i class="fa fa-plus"></i></span>
                            </h2>
                            <p class="achievement_text" style="text-transform:uppercase; font-size: small ">{{ $achiveitem->sub_title }}</p>
                            <div class="achievement_item_shape"></div>
                        </div>
                    @endforeach
                {{-- @endif --}}

            @endisset


        </div>
    </div>
</section>
<!-- Our Achievement end -->
