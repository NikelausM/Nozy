@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				<h1 class="font-weight-bold">Notifications</h1>
				@foreach($notifications as $notification)
        @include('layouts.notifications_box')
        @endforeach
			</div>
		</div>
	</div>
</div>
@endsection
