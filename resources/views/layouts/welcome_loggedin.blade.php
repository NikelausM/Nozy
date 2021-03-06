<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('partials.head')
	</head>
    <body>
        <div id="app">

					<script type="text/javascript">
							<?php
							Log::info('start unique_id: '.Session::get('unique_id'));
							Session::put('unique_id', 1);
							Log::info('end unique_id: '.Session::get('unique_id'));
							?>
					</script>
          @include('layouts.nav_loggedin') <!--References layout/nav.blade/php which is the navigation header-->
          @include('layouts.modal_loggedin')
          @yield('content')


        </div>
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    </body>
</html>
