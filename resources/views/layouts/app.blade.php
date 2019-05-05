<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="theme-light bg-page">
    <div id="app">
        <nav class="bg-header">
            <div class="container mx-auto">
               <div class="flex justify-between py-3 items-center">
                  <a class="navbar-brand flex items-center" href="{{ url('/') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="291" height="45" viewBox="0 0 291 45" class="text-default relative" style="top: 2px">
                        <g fill="none" fill-rule="evenodd">
                            <g class="fill-current">
                                <path d="M58.544 19.568c1.056 0 1.988.26 2.796.78.808.52 1.436 1.252 1.884 2.196.448.944.672 2.04.672 3.288 0 1.248-.228 2.356-.684 3.324-.456.968-1.088 1.716-1.896 2.244-.808.528-1.732.792-2.772.792-.896 0-1.692-.192-2.388-.576a3.762 3.762 0 0 1-1.572-1.608V32h-2.952V14.336h2.976v7.368a3.893 3.893 0 0 1 1.584-1.572c.688-.376 1.472-.564 2.352-.564zm-.792 10.272c.992 0 1.76-.352 2.304-1.056.544-.704.816-1.688.816-2.952 0-1.248-.272-2.212-.816-2.892-.544-.68-1.32-1.02-2.328-1.02-1.008 0-1.784.344-2.328 1.032-.544.688-.816 1.664-.816 2.928 0 1.28.272 2.26.816 2.94.544.68 1.328 1.02 2.352 1.02zm8.76 2.16V19.88h2.976V32h-2.976zm-.192-17.616h3.336v2.952H66.32v-2.952zm12.984 5.208c.464 0 .864.064 1.2.192l-.024 2.736a4.171 4.171 0 0 0-1.584-.312c-1.024 0-1.804.296-2.34.888-.536.592-.804 1.376-.804 2.352V32h-2.976v-8.688c0-1.28-.064-2.424-.192-3.432h2.808l.24 2.136c.304-.784.784-1.384 1.44-1.8.656-.416 1.4-.624 2.232-.624zm14.232-5.256V32h-2.952v-1.944A3.893 3.893 0 0 1 89 31.628c-.688.376-1.472.564-2.352.564-1.04 0-1.968-.264-2.784-.792-.816-.528-1.452-1.276-1.908-2.244-.456-.968-.684-2.076-.684-3.324 0-1.248.224-2.344.672-3.288.448-.944 1.08-1.676 1.896-2.196.816-.52 1.752-.78 2.808-.78.864 0 1.636.18 2.316.54a3.8 3.8 0 0 1 1.572 1.524v-7.296h3zM87.44 29.84c.992 0 1.764-.344 2.316-1.032.552-.688.828-1.664.828-2.928s-.272-2.24-.816-2.928c-.544-.688-1.312-1.032-2.304-1.032-1.008 0-1.788.34-2.34 1.02-.552.68-.828 1.644-.828 2.892 0 1.264.276 2.248.828 2.952.552.704 1.324 1.056 2.316 1.056zm16.272-10.272c1.056 0 1.988.26 2.796.78.808.52 1.436 1.252 1.884 2.196.448.944.672 2.04.672 3.288 0 1.248-.228 2.356-.684 3.324-.456.968-1.088 1.716-1.896 2.244-.808.528-1.732.792-2.772.792-.896 0-1.692-.192-2.388-.576a3.762 3.762 0 0 1-1.572-1.608V32H96.8V14.336h2.976v7.368a3.893 3.893 0 0 1 1.584-1.572c.688-.376 1.472-.564 2.352-.564zm-.792 10.272c.992 0 1.76-.352 2.304-1.056.544-.704.816-1.688.816-2.952 0-1.248-.272-2.212-.816-2.892-.544-.68-1.32-1.02-2.328-1.02-1.008 0-1.784.344-2.328 1.032-.544.688-.816 1.664-.816 2.928 0 1.28.272 2.26.816 2.94.544.68 1.328 1.02 2.352 1.02zm14.256 2.352c-1.232 0-2.316-.256-3.252-.768a5.245 5.245 0 0 1-2.16-2.196c-.504-.952-.756-2.068-.756-3.348 0-1.28.252-2.396.756-3.348a5.245 5.245 0 0 1 2.16-2.196c.936-.512 2.02-.768 3.252-.768 1.216 0 2.288.256 3.216.768a5.264 5.264 0 0 1 2.148 2.196c.504.952.756 2.068.756 3.348 0 1.28-.252 2.396-.756 3.348a5.264 5.264 0 0 1-2.148 2.196c-.928.512-2 .768-3.216.768zm-.024-2.352c1.024 0 1.804-.332 2.34-.996.536-.664.804-1.652.804-2.964 0-1.296-.272-2.284-.816-2.964-.544-.68-1.312-1.02-2.304-1.02-1.008 0-1.784.34-2.328 1.02-.544.68-.816 1.668-.816 2.964 0 1.312.268 2.3.804 2.964.536.664 1.308.996 2.316.996zm20.328-9.96V32h-2.952v-1.944a3.893 3.893 0 0 1-1.584 1.572c-.688.376-1.472.564-2.352.564-1.056 0-1.992-.256-2.808-.768-.816-.512-1.448-1.24-1.896-2.184-.448-.944-.672-2.04-.672-3.288 0-1.248.228-2.356.684-3.324.456-.968 1.092-1.72 1.908-2.256.816-.536 1.744-.804 2.784-.804.88 0 1.664.188 2.352.564.688.376 1.216.9 1.584 1.572V19.88h2.952zm-6.072 9.96c.992 0 1.76-.344 2.304-1.032.544-.688.816-1.656.816-2.904 0-1.28-.272-2.264-.816-2.952-.544-.688-1.32-1.032-2.328-1.032-.992 0-1.764.356-2.316 1.068-.552.712-.828 1.7-.828 2.964 0 1.248.276 2.208.828 2.88.552.672 1.332 1.008 2.34 1.008zm15.864-10.248c.464 0 .864.064 1.2.192l-.024 2.736a4.171 4.171 0 0 0-1.584-.312c-1.024 0-1.804.296-2.34.888-.536.592-.804 1.376-.804 2.352V32h-2.976v-8.688c0-1.28-.064-2.424-.192-3.432h2.808l.24 2.136c.304-.784.784-1.384 1.44-1.8.656-.416 1.4-.624 2.232-.624zm14.232-5.256V32h-2.952v-1.944a3.893 3.893 0 0 1-1.584 1.572c-.688.376-1.472.564-2.352.564-1.04 0-1.968-.264-2.784-.792-.816-.528-1.452-1.276-1.908-2.244-.456-.968-.684-2.076-.684-3.324 0-1.248.224-2.344.672-3.288.448-.944 1.08-1.676 1.896-2.196.816-.52 1.752-.78 2.808-.78.864 0 1.636.18 2.316.54a3.8 3.8 0 0 1 1.572 1.524v-7.296h3zm-6.096 15.504c.992 0 1.764-.344 2.316-1.032.552-.688.828-1.664.828-2.928s-.272-2.24-.816-2.928c-.544-.688-1.312-1.032-2.304-1.032-1.008 0-1.788.34-2.34 1.02-.552.68-.828 1.644-.828 2.892 0 1.264.276 2.248.828 2.952.552.704 1.324 1.056 2.316 1.056z"></path>
                            </g>
                            <path class="stroke-current" stroke-opacity=".218" stroke-width=".5" d="M12.454 37L9 39.784l6.598.852L12.299 43 26 40.636"></path>
                            <path fill="#47D5Fa" d="M42.273 4C27.487 4 15.326 15.078 14.037 29.157c2.457-3.374 5.466-6.621 9.223-10.354a.738.738 0 0 1 1.029-.01c.286.273.29.722.01 1.001a169.806 169.806 0 0 0-2.688 2.732l-.175.184c-4.643 4.842-7.962 9.057-10.372 14.291a.702.702 0 0 0 .365.937.74.74 0 0 0 .963-.356 38.585 38.585 0 0 1 2.974-5.273c10.159-.253 19.406-5.757 24.252-14.515a.696.696 0 0 0-.016-.7.737.737 0 0 0-.625-.344h-2.694l4.83-2.689a.714.714 0 0 0 .328-.384A26.88 26.88 0 0 0 43 4.708.718.718 0 0 0 42.273 4z"></path>
                        </g>
                    </svg>
                  </a>

                   <div>
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
            </div>
        </nav>

        <main class="container mx-auto py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
