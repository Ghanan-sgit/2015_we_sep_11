<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA | Login</title>
    <link href="{{asset('public_assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/style.css')}}" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">SLIIT</h1>
        </div>
        <h3>Welcome to SLIIT Research Management Application</h3>
        <!--p>ssd
        </p-->
        <p>Login in. To see it in action.</p>
        <form class="m-t" role="form" method="POST" action="{{ url('/auth/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Username" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <a href="{{ url('/password/email') }}"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
        </form>
        <p class="m-t"> <small>SLIIT Research Management &copy; 2015</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('public_assets/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('public_assets/js/bootstrap.min.js')}}"></script>

</body>

</html>