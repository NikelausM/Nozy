<?php // Errors ?>
@include('profile.profile_update_errors')

<?php Session::put('unique_id', Session::get('unique_id') + 1)?>
@if(Session::has("update_user_error_".Session::get('unique_id')))
<?php $update_user_error_id = Session::get("update_user_error_".Session::get('unique_id')) ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($update_user_error_id);?></font></div>
<?php Session::forget($update_user_error_id) ?>

@if(count($errors->updateUserErrors)>0)
<div class="alert alert-danger">
    @foreach($errors->updateUserErrors->all() as $error)
      <p><font color = "red">{{$error}}</font></p>
    @endforeach
  </div>
@endif
@endif

<!--show/hide form on button click-->
<div id={{"details_user_".$user->id}} style="display:none">
	<form action={{route('user.update', $user)}} method="post">
	  <div class="form-group">
			<div class="row-1">
	      <div class="col-75" style="display: none;">
	        <input type="number" id="unique_id" name="unique_id" value={{Session::get('unique_id')}}>
	      </div>
	    </div>
		  <label for="inputName">Name</label>
				<input type="name" class="form-control" name="name" id="name" placeholder="{{$user->profile->name}}" value="{{$user->profile->name}}" required>
		  <label for="inputPassword">Password</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="{{$user->profile->password}}", value="{{$user->profile->password}}" required>
		  <label for="inputEmail">Description</label>
				<input type="description" class="form-control" name="description" id="description" placeholder="{{$user->profile->description}}", value="{{$user->profile->description}}" required>
		  <label for="inputEmail">Email</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="{{$user->email}}", value="{{$user->email}}" required>
		  <label for="inputAge">Age</label>
				<input type="number" class="form-control" name="age" id="age" placeholder="{{$user->age}}", value="{{$user->age}}" required>
		  <button style="margin-top: 5px;" class="btn btn-primary" type="submit" required>Save profile info</button>
		  {{csrf_field()}}
	  </div>
	</form>
</div>
<button style="margin-top: 5px;" class="btn btn-primary" id="more_user" href="" onclick={{"show_hide_user(".$user->id.")"}} > Edit Profile</button>
<script>
function show_hide_user(id) {
var user_id = "details_user_";
user_id = user_id.concat(id);
var x = document.getElementById(user_id);
if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
