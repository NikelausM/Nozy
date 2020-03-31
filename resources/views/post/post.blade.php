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
				<h2> Comments </h2>
				@if(Session::has("show_comments_error"))
				<div class="alert alert-danger"><?php echo nl2br(Session::get("show_comments_error"));?></div>
				@elseif(Session::has("no_comments_message"))
				<div class="alert alert-info"><?php echo nl2br(Session::get("no_comments_message"));?></div>
				@else
				@foreach($comments as $comment)
				@include('comment.comment_box')
				@endforeach
				@endif
				<?php $parent_id = 0; // Parent id is -1 because these comments are post comments?>
				@include('comment.make_comment_button')
			</div>
		</div>
	</div>
</div>
@endsection
