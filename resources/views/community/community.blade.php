@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				<h1 class="font-weight-bold">Welcome to {{$community->profile->name}}</h1>
				<h2 class="font-weight-bold">Description: {{$community->profile->description}}</h2>
				@if(Auth::guard('profile')->user()->id == $community->manager_user_id)
				@include('community.edit_community_profile_form')
				@endif
				<h2 class="font-weight-bold"><font color="black">Posts</font></h2>
				@foreach($community->profile->posts as $post)
				@include('layouts.post_box')
				@endforeach
				@include('layouts.makePost_button')
			</div>
		</div>
	</div>
</div>
@endsection
