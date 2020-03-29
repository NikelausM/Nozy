@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				@include('layouts.follow_profile_button')
				<h1 class="font-weight-bold"><font color="black">{{$user->profile->name}}</font></h1>
				<h1 class="font-weight-bold"><font color="black">{{$user->profile->description}}</font></h1>
				@if(Auth::guard('profile')->user()->id == $user->profile->id)
				@include('user.edit_user_profile_form')
				@endif
				<h2 class="font-weight-bold"><font color="black">Communities Managed</font></h2>
				@foreach($user->communities as $community)
				@include('layouts.community_box')
				@endforeach
				@if(Auth::guard('profile')->user()->id == $user->profile->id)
				@include('layouts.makeCommunity_button')
				@endif
				<h2 class="font-weight-bold"><font color="black">Posts</font></h2>
				@foreach($user->profile->posts->sortByDesc('updated_at') as $post)
				@include('layouts.post_box')
				@endforeach
				@include('layouts.makePost_button')
				<br></br>
				<br></br>
			</div>
		</div>
	</div>
</div>
@endsection
