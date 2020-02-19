<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('partials.head')
	</head>
    <body>
        <div id="app">
            @include('layouts.nav') <!--References layout/nav.blade/php which is the navigation header-->
            @include('layouts.modal')
            @yield('content')
            
            
        </div>
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    </body>
</html>
