<div class="row" style="padding: 10px">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail shadow">
			<h3><font color="black">{{ $post->subject }}</font></h3>
			<div class="caption">
				<p><font color="black">{{ $post->body }}</font></p>
				<div>
					@if(Auth::guard('profile')->user()->id == $post->posted_by_profile->id)
					@include('post.edit_post_form')
					@include('post.delete_post_button')
					@endif
					<form method="GET" action={{route('post.show', $post)}} accept-charset="UTF-8">
						<button type="submit" class="btn btn-primary">Go to post</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
