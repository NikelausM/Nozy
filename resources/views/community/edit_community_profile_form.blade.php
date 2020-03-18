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
	<form action={{route('community.update', $community)}} method="post">
	  <div class="form-group">
		  <label for="inputName">Name</label>
				<input type="name" class="form-control" name="name" id="name" placeholder="{{$community->profile->name}}" value="{{$community->profile->name}}">
		  <label for="inputPassword">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="{{$community->profile->password}}", value="{{$community->profile->password}}">
		  <label for="inputEmail">Description</label>
				<input type="description" class="form-control" name="description" id="description" placeholder="{{$community->profile->description}}", value="{{$community->profile->description}}">
		  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Save profile info</button>
		  {{csrf_field()}}
	  </div>
	</form>
</div>
<button style="margin-top: 5px;" class="btn btn-primary" id="more" href="" onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'Stop Community Editing Profile':'Edit Community Profile');});">Edit Community Profile</button>
