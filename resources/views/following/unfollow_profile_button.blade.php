<?php //Check if unfollowing error exists ?>
@if(Session::has("unfollowing_profile_error"))
<?php $unfollowing_profile_error = Session::get("unfollowing_profile_error") ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($unfollowing_profile_error);?></font></div>
<?php Session::forget($unfollowing_profile_error) ?>
@endif
<div class="container form-group">
	<form action={{route('following.destroyFollowingProfile', $profile)}} method="post">
		<input name="_method" type="hidden" value="delete">
		<div class="row-1">
		  <input type="submit" style="background-color: red" value="Unfollow Profile">
			{{csrf_field()}}
		</div>
	</form>
</div>
