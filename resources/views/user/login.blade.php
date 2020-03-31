<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Log In</h5>
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
<form action={{route('user.postLogin')}} method="post">
  <div class="modal-body form-group">
	  <div class="row">
		<div class="col">
			<label for="inputName">Name</label>
			<input type="name" class="form-control" name="name" id="name" placeholder="Enter Name" required>
		</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="inputPassword">Password</label>
			<input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
		</div>
	  </div>
	  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Log In</button>
	  {{csrf_field()}}
  </div>
</form>
