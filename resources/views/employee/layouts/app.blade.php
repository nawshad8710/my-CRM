<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags-->
        @include('employee.layouts.partials.meta')

        <!-- Title Page-->
        <title>@yield('title') :: {{config('app.name')}}</title>
        
        <!-- Page head styles -->
        @include('employee.layouts.partials.style')

        @stack('css')
    </head>

    <body>
        <div class="page-wrapper">
            <!-- HEADER MOBILE-->
            @include('employee.layouts.partials.mobile-header')
            <!-- END HEADER MOBILE-->

            <!-- MENU SIDEBAR-->
            @include('employee.layouts.partials.sidebar')
            <!-- END MENU SIDEBAR-->

            <!-- PAGE CONTAINER-->
            <div class="page-container">
                <!-- HEADER DESKTOP-->
                @include('employee.layouts.partials.desktop-header')
                <!-- HEADER DESKTOP-->

                <!-- MAIN CONTENT-->
                @yield('content')
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
            </div>

        </div>

        <!-- Page head scripts -->
        @include('employee.layouts.partials.script')
        @stack('js')

        {!! Toastr::message() !!}
    </body>
</html>
<!-- end document-->
