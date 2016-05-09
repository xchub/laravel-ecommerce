<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-commerce Admin</title>

    <!-- jQuery -->

    <script src="/bower_components/jquery/dist/jquery.js"></script>

    <!-- Bootstrap -->

    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Angular Material -->

    <link rel="stylesheet" href="/bower_components/angular-material/angular-material.css">
    <script src="/bower_components/angular/angular.min.js"></script>
    <script src="/bower_components/angular-aria/angular-aria.js"></script>
    <script src="/bower_components/angular-animate/angular-animate.js"></script>
    <script src="/bower_components/angular-material/angular-material.js"></script>

    <!-- Application -->

    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <script src="/js/app.js"></script>

</head>

<body id="app-layout" ng-app="EcommerceApp">

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">E-commerce Admin</a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <ul class="nav navbar-nav">
                    <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <li><a href="{{ url('/admin') }}">Dashboard</a></li>

                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
</html>