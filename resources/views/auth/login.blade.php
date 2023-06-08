<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    @section('title', 'Login')

    <!-- Page head styles -->
    @include('admin.layouts.partials.style')

    <style>
        .page-content--bge5 {
            background-image: url("/assets/images/backgroundimg.png");
            background-repeat: no-repeat, repeat;
            background-color: #cccccc;
            background-size: cover;
        }

        .page-wrapper {
            padding-bottom: 0px;
        }
    </style>
</head>

<body class="">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-logo">
                        <a href="#">
                            <span style="font-size: 30px; color: #ddd; font-weight: bold;">Login Now</span>
                        </a>
                    </div>
                    <div class="login-content">
                        <div class="login-form">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <button class="au-btn au-btn--blue m-b-20" type="submit">sign in</button>
                                <!-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                                        <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                                    </div>
                                </div> -->
                            </form>
                            <!-- <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Page head scripts -->
    @include('admin.layouts.partials.script')

</body>

</html>
<!-- end document-->