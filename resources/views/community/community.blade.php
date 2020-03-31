@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br><br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				@include('following.follow_profile_button')
				@include('following.unfollow_profile_button')
				<h1 class="font-weight-bold">Welcome to {{$community->profile->name}}</h1>
				<h2 class="font-weight-bold">Description: {{$community->profile->description}}</h2>
				@if(Auth::guard('profile')->user()->id == $community->manager_user_id)
				@include('community.edit_community_profile_form')
				@include('community.delete_community_button')
				@endif
				<br><br>
				<h2 class="font-weight-bold">Posts</h2>
				@foreach($community->profile->posts->sortByDesc('updated_at') as $post)
				@include('post.post_box')
				@endforeach
				@include('post.makePost_button')
			</div>
		</div>
	</div>
</div>
@endsection
