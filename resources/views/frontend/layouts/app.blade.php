<!DOCTYPE html>
<html lang="en">
    @php
    $siteInfo = optional(\App\Models\Admin\SiteInfo::find(1));


    @endphp
<head>
     <!-- Required meta tags-->
   @include('frontend.layouts.partials.meta')
    {{-- <title>Classic It and Sky Mart</title> --}}
     <!-- Title Page-->
    <title>@yield('title') :: {{config('app.name')}}</title>
     <!-- Page head styles -->
  @include('frontend.layouts.partials.style')
  @stack('css')
</head>

<body>
    @include('sweetalert::alert')
    <!-- header section -->
  @include('frontend.layouts.partials.header')
    <!-- header section end -->

    @yield('section')

    <!-- footer section -->
   @include('frontend.layouts.partials.footer')
    <!-- footer section end -->

   @include('frontend.layouts.partials.script')
   @stack('js')
</body>

</html>
