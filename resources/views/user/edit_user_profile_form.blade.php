<!--Print out any errors with form inputs-->
@if(count($errors)>0)
<div class="alert alert-danger">
		@foreach($errors->all() as $error)
			<p><font color = "red">{{$error}}</font></p>
		@endforeach
	</div>
@endif
<!--show/hide form on button click-->
<div class="details" style="display:none">
	<form action={{route('user.update', $user->id)}} method="post">
	  <div class="form-group">
		  <label for="inputName">Name</label>
				<input type="name" class="form-control" name="name" id="name" placeholder="{{$user->profile->name}}" value="{{$user->profile->name}}">
		  <label for="inputPassword">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="{{$user->profile->password}}", value="{{$user->profile->password}}">
		  <label for="inputEmail">Description</label>
				<input type="description" class="form-control" name="description" id="description" placeholder="{{$user->profile->description}}", value="{{$user->profile->description}}">
		  <label for="inputEmail">Email</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="{{$user->email}}", value="{{$user->email}}">
		  <label for="inputAge">Age</label>
				<input type="age" class="form-control" name="age" id="age" placeholder="{{$user->age}}", value="{{$user->age}}">
		  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Save profile info</button>
		  {{csrf_field()}}
	  </div>
	</form>
</div>
<button style="margin-top: 5px;" class="btn btn-primary" id="more" href="" onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'Stop Editing Profile':'Edit Profile');});">Edit Profile</button>
