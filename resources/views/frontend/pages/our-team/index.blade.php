@extends('frontend.layouts.app')

@section('title', 'Our Team')
@push('css')
@endpush

@section('section')

<main class="main">
    <!-- breadcamb -->
    <div class="breadcamb section_padding">
        <div class="container">
            <h2 class="breadcamb_title">Our Team</h2>
        </div>
    </div>
    <!-- breadcamb end -->

    <!-- team section -->
    <section class="team_section section_padding">
        <div class="container">
            <!-- team title -->
            <div class="section_title text-start mw-100 mb-3">
                <!-- title heading -->
                <h1 class="section_heading">Developer Team</h1>
            </div>
            <!-- team wrapper -->
            <div class="team_wrapper mb-5">

                @isset($developerTeams)
                @foreach ($developerTeams as $key=> $developerTeam)
                <div class="team_card">
                    <!-- team image -->
                    <div class="team_image">
                        <img src="{{asset('assets/images/uploads/our-team/' . $developerTeam->image)}}" alt="">
                    </div>
                    <!-- content -->
                    <div class="team_content">
                        <!-- team name -->
                        <p class="team_name">{{$developerTeam->name}}</p>
                        <!-- team designation -->
                        <p class="team_designation">{{$developerTeam->designation}}</p>
                        <!-- team social -->
                        <div class="team_social">

                        </div>
                    </div>
                </div>
                @endforeach

                @endisset

            </div>

            <!-- team title -->
            <div class="section_title text-start mw-100 mb-3">
                <!-- title heading -->
                <h1 class="section_heading">Marketing Team</h1>
            </div>
            <!-- team wrapper -->
            <div class="team_wrapper">
                <!-- team card -->

              @isset($salesTeams)
              @foreach ($salesTeams as $key=> $salesTeam)
              <div class="team_card">
                <!-- team image -->
                <div class="team_image">
                    <img src="{{asset('assets/images/uploads/our-team/' .$salesTeam->image)}}" alt="">
                </div>
                <!-- content -->
                <div class="team_content">
                    <!-- team name -->
                    <p class="team_name">{{$salesTeam->name}}</p>
                    <!-- team designation -->
                    <p class="team_designation">{{$salesTeam->designation}}</p>
                    <!-- team social -->
                    <div class="team_social">

                    </div>
                </div>
            </div>
              @endforeach

              @endisset
            </div>
        </div>
    </section>
    <!-- team section end -->

    <!-- choose -->
    <div class="why_choose section_padding">
        <div class="container">
            <!-- why_choose_wrapper -->
            <div class="why_choose_wrapper">
                <!-- why_choose_image -->
                <div class="why_choose_image">
                    <img src="assets/image/holder/banner.png" alt="">
                </div>
                <!-- why_choose_content -->
                <div class="why_choose_content">
                    <!-- section ttile -->
                    <div class="section_title text-start mw-100">
                        <!-- title heading -->
                        <h1 class="section_heading">Why Speacial<span> Classicit?</span></h1>
                        <!-- section text -->
                        <p class="section_text">We can help you Uplift your Business and Boost your Revenue using Latest Technological Solutions. Instead of feeding unnecessary services and implementations that increases your cost, we provide only just the solution that’s best for your business.</p>
                    </div>
                    <!-- text -->
                    <div class="why_choose_inner">
                        <!-- why_choose_box -->
                        <div class="why_choose_box">
                            <!-- image -->
                            <div class="why_bxchoose_image">
                                <img src="assets/image/holder/qa.png" alt="">
                            </div>
                            <!-- right -->
                            <div class="why_choose_right">
                                <p class="why_choose_title">Communication</p>
                                <p class="why_choose_text">
                                    Effective communication is arguably the number one skill required software.
                                </p>
                            </div>
                        </div>
                        <!-- why_choose_box -->
                        <div class="why_choose_box">
                            <!-- image -->
                            <div class="why_bxchoose_image">
                                <img src="assets/image/holder/w3.png" alt="">
                            </div>
                            <!-- right -->
                            <div class="why_choose_right">
                                <p class="why_choose_title">Experience</p>
                                <p class="why_choose_text">
                                    We are more experienced that allows creating a finished solution.
                                </p>
                            </div>
                        </div>
                        <!-- why_choose_box -->
                        <div class="why_choose_box">
                            <!-- image -->
                            <div class="why_bxchoose_image">
                                <img src="assets/image/holder/project.png" alt="">
                            </div>
                            <!-- right -->
                            <div class="why_choose_right">
                                <p class="why_choose_title">Safe &amp; Secure</p>
                                <p class="why_choose_text">
                                    We follow robust data security strategies will protect an organization’s information.
                                </p>
                            </div>
                        </div>
                        <!-- why_choose_box -->
                        <div class="why_choose_box">
                            <!-- image -->
                            <div class="why_bxchoose_image">
                                <img src="assets/image/holder/w1.png" alt="">
                            </div>
                            <!-- right -->
                            <div class="why_choose_right">
                                <p class="why_choose_title">Passion for Testing</p>
                                <p class="why_choose_text">
                                    We test regularly can ensure the level of quality that encourages the diligence o find bugs
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- choose end -->

    <!-- our clint section -->
    <div class="clint_section section_padding">
        <div class="container">
            <!-- clint slider -->
            <div class="clint_slider">
                <!-- clint item -->
                <div class="clint_item">
                    <img src="assets/image/holder/gloumer.png" alt="">
                </div>
                <!-- clint item -->
                <div class="clint_item">
                    <img src="assets/image/holder/mspotidin.png" alt="">
                </div>
                <!-- clint item -->
                <div class="clint_item">
                    <img style="filter: contrast(0.5);" src="assets/image/holder/janani.png" alt="">
                </div>
                <!-- clint item -->
                <div class="clint_item">
                    <img src="assets/image/holder/markwrapper.png" alt="">
                </div>
                <!-- clint item -->
                <div class="clint_item">
                    <img src="assets/image/holder/Mousumi.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- our clint section end -->
</main>



@endsection
@push('js')
@endpush
