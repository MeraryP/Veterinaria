<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/select.dataTables.min.css')}}">


<script type="text/javascript" src="{{asset('JS/jquery-3.5.1.js')}}"></script>
<script type="text/javascript" src="{{asset('JS/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('JS/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('JS/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('JS/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('JS/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('JS/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('JS/buttons.print.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('JS/dataTables.select.min.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('css')


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
                        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    @stack('js')
    <script src="{{ asset('JS/jquery.dataTables.min.js') }}"></script>
       <script src="{{ asset('JS/dataTables.bootstrap.min.js') }}"></script>
       <script src="{{ asset('JS/dataTables.buttons.min.js') }}"></script>

       <script src="{{ asset('JS/dataTables.fixedHeader.min.js') }}"></script>
       <script src="{{ asset('JS/dataTables.keyTable.min.js') }}"></script>
       <script src="{{ asset('JS/dataTables.responsive.min.js') }}"></script>

       <script src="{{ asset('JS/dataTables.scroller.min.js') }}"></script>

       <script src="{{ asset('JS/buttons.html5.min.js') }}"></script>
       <script src="{{ asset('JS/buttons.print.min.js') }}"></script>

       <script src="{{ asset('JS/buttons.bootstrap.min.js') }}"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
        
   
</body>
</html>
