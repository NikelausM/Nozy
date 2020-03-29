<?php //Check if unfollowing error exists ?>
@if(Session::has("unfollowing_post_error"))
<?php $unfollowing_post_error = Session::get("unfollowing_post_error") ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($unfollowing_post_error);?></font></div>
{{Session::forget($unfollowing_post_error)}}
@endif
<div class="container form-group">
	<form action={{route('following.destroyFollowingPost', $post)}} method="post">
		<input name="_method" type="hidden" value="delete">
		<div class="row-1">
		  <input type="submit" style="background-color: red" value="Unfollow Post">
			{{csrf_field()}}
		</div>
	</form>
</div>
