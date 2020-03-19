@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				<h1 class="font-weight-bold">Search Nozy!</h1>
				<h2 class="font-weight-bold">Users</h2>
				@foreach($users as $user)
				@include('layouts.user_box')
				@endforeach
				<h2 class="font-weight-bold">Communities</h2>
				@foreach($communities as $community)
				@include('layouts.community_box')
				@endforeach
				<h2 class="font-weight-bold"><font color="black">Posts</font></h2>
				@foreach($posts as $post)
				@include('layouts.post_box')
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
