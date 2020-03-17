@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				<h1 class="font-weight-bold"><font color="black">{{$user->profile->name}}</font></h1>
				<h1 class="font-weight-bold"><font color="black">{{$user->profile->description}}</font></h1>
				@if(Auth::guard('profile')->user()->id == $user->profile->id)
				@include('user.edit_user_profile_form')
				@endif
				<h2 class="font-weight-bold"><font color="black">Communities</font></h2>
				@include('layouts.makeCommunity_button')
				@foreach($user->communities as $community)
				@include('layouts.community_box')
				@endforeach
				<h2 class="font-weight-bold"><font color="black">Posts</font></h2>
				@include('layouts.makePost_button')
				@foreach($user->profile->posts as $post)
				@include('layouts.post_box')
				@endforeach
				<br></br>
				<br></br>
			</div>
		</div>
	</div>
</div>
@endsection
