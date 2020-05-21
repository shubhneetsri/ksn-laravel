<!DOCTYPE html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Example</title>

        <!-- css -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- js -->
        <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.js') }}"></script>
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>
    
        <div class="jumbotron">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm">
            <div class="container">
                <h3>
                    {{__('display.project.student_module')}}
                </h3>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="/" >
                                        Home
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        </div>

        <div class="container">
            @yield('content')
        </div>

         <!-- Footer -->
         <footer class="page-footer font-small blue">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">@Example</div>
        <!-- Copyright -->

        </footer>
        <!-- Footer -->
    </body>
</html>

