<div class="row" style="padding: 10px">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail shadow">
			<h3 class="font-weight-bold"><font color="black">Posted by {{$post->posted_by_profile->name}}</font></h3>
			<h3><font color="black">{{ $post->subject }}</font></h3>
			<div class="caption">
				<p><font color="black">{{ $post->body }}</font></p>
				<div>
					@if(Auth::guard('profile')->user()->id == $post->posted_by_profile->id)
					@include('post.edit_post_form')
					@include('post.delete_post_button')
					@endif
					@include('post.show_post_button')
				</div>
			</div>
		</div>
	</div>
</div>
