<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
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
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container py-4">
            <div class="row">
                @if(Auth::check())
                <div class="col-md-4">

                    <div class="card">

                        <div class="card-header">
                            sidebar
                        </div>
                        <div class="card-body">

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="{{route('category.create')}}">Add category</a>

                                </li>



                                <li class="list-group-item">

                                    <a href="{{route('tag.create')}}">Add tags</a>

                                </li>



                                <li class="list-group-item">


                                    <a href="{{route('post.create')}}">Add Post</a>

                                </li>




                                <li class="list-group-item">

                                    <a href="{{route('category-trashed')}}">Show Trashed Category</a>

                                </li>


                                <li class="list-group-item">

                                    <a href="{{route('post-trashed')}}">Show Trashed post</a>

                                </li>


                                <li class="list-group-item">


                                    <a href="{{route('tag-trashed')}}">Show Trashed tag</a>

                                </li>



                                <li class="list-group-item">

                                    <a href="{{route('category.index')}}">show all category</a>

                                </li>


                                <li class="list-group-item">

                                    <a href="{{route('post.index')}}">show all post</a>

                                </li>


                                <li class="list-group-item">

                                    <a href="{{route('tag.index')}}">show all tags</a>

                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
                <div class="col-md-8">


                    @yield('content')

                </div>

                @else

                @yield('content')

                @endif
            </div>
        </main>


    </div>

    @yield('scripts')

</body>

</html>