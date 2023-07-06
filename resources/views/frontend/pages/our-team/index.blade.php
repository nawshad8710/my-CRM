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
    @include('frontend.components.why-choose-us')
    <!-- choose end -->

    <!-- our clint section -->
    @include('frontend.components.our-client')
    <!-- our clint section end -->
</main>



@endsection
@push('js')
@endpush
