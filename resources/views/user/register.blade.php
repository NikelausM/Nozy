<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Register</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div>
<?php // Errors ?>
@include('profile.profile_store_errors')

<?php Session::put('unique_id', Session::get('unique_id') + 1)?>
@if(Session::has("store_user_error_".Session::get('unique_id')))
<?php $store_user_error_id = Session::get("store_user_error_".Session::get('unique_id')) ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($store_user_error_id);?></font></div>
<?php Session::forget($store_user_error_id) ?>

@if(count($errors->storeUserErrors)>0)
<div class="alert alert-danger">
    @foreach($errors->storeUserErrors->all() as $error)
      <p><font color = "red">{{$error}}</font></p>
    @endforeach
  </div>
@endif
@endif
<form action={{route('user.store')}} method="post">
  <div class="modal-body form-group">
		<div class="row-1">
      <div class="col-75" style="display: none;">
        <input type="number" id="unique_id" name="unique_id" value={{Session::get('unique_id')}}>
      </div>
    </div>
	  <div class="row">
			<div class="col">
				<label for="name">Name</label>
				<input class="form-control" name="name" id="name" placeholder="Enter Name" required>
			</div>
	  </div>
	  <div class="row">
			<div class="col">
				<label for="inputPassword">Password</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="Enter password" required>
			</div>
	  </div>
	  <div class="row">
			<div class="col">
				<label for="description">Personal Description</label>
				<input class="form-control" name="description" id="description" placeholder="Enter Personal Description" required>
			</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="inputEmail">Email address</label>
			<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
		</div>
	  </div>
	  <div class="row">
			<div class="col">
				<label for="age">Age</label>
				<input type="number" class="form-control" name="age" id="age" placeholder="Enter Age" required>
			</div>
	  </div>
	  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Register</button>
	  {{csrf_field()}}
  </div>
</form>
