<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('partials.head')
	</head>
    <body>
        <div id="app">
            @include('layouts.nav_admin') <!--References layout/nav.blade/php which is the navigation header-->
            @yield('content')
        </div>
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    </body>
</html>
