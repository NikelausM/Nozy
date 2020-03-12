<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div>
@if(count($errors)>0)
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
			<p><font color = "red">{{$error}}</font></p>
		@endforeach
	</div>
@endif
<form action={{'user/register'}} method="post">
  <div class="modal-body form-group">
	  <div class="row">
		<div class="col">
			<label for="name">Name</label>
			<input class="form-control" name="name" id="name" placeholder="Enter Name">
		</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="description">Personal Description</label>
			<input class="form-control" name="description" id="description" placeholder="Enter Personal Description">
		</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="inputEmail">Email address</label>
			<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
		</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="inputPassword">Password</label>
			<input class="form-control" name="password" id="password" placeholder="Enter password">
		</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="age">Age</label>
			<input class="form-control" name="age" id="age" placeholder="Enter Age">
		</div>
	  </div>
	  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Register</button>
	  {{csrf_field()}}
  </div>
</form>
