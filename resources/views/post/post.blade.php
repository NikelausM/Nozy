@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				@include('following.follow_post_button')
				@include('following.unfollow_post_button')
				@include('post.like_post_button')
				@include('post.dislike_post_button')
				<h1 class="font-weight-bold">Post: {{$post->subject}}</h1>
				<p class="font-weight-bold">Rating: {{$post->rating}}</p>
				<p class="font-weight-bold">Description: {{$post->body}}</p>
				@if(Auth::guard('profile')->user()->id == $post->posted_by_profile->id)
				@include('post.edit_post_form')
				@include('post.delete_post_button')<!-- I want this to be to the right of edit_post_form-->
				@endif
				<?php $user = \App\User::where('profile_id',$post->posted_on_profile->id)->first(); ?>
				@if(!is_null($user))
				@include('user.show_user_button')
				@else
				<?php $community = \App\Community::where('profile_id',$post->posted_on_profile->id)->first(); ?>
				@include('community.show_community_button')
				@endif
				<h2> Comments </h2>
				@include('post.show_post_comments')
				<?php $parent_id = 0; // Parent id is 0 because these comments are post comments?>
				@include('comment.make_comment_button')
			</div>
		</div>
	</div>
</div>
@endsection
