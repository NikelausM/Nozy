<!--Print out any errors with form inputs-->

<?php // Errors ?>
@include('profile.profile_update_errors')

<?php Session::put('unique_id', Session::get('unique_id') + 1)?>
@if(Session::has("update_community_error_".Session::get('unique_id')))
<?php $update_community_error_id = Session::get("update_community_error_".Session::get('unique_id')) ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($update_community_error_id);?></font></div>
<?php Session::forget($update_community_error_id) ?>

@if(count($errors->updateCommunityErrors)>0)
<div class="alert alert-danger">
    @foreach($errors->updateCommunityErrors->all() as $error)
      <p><font color = "red">{{$error}}</font></p>
    @endforeach
  </div>
@endif
@endif

<!--show/hide form on button click-->
<div id={{"details_community_".$community->id}} style="display:none">
	<form action={{route('community.update', $community)}} method="post">
	  <div class="form-group">
			<div class="row-1">
	      <div class="col-75" style="display: none;">
	        <input type="number" id="unique_id" name="unique_id" value={{Session::get('unique_id')}}>
	      </div>
	    </div>
		  <label for="inputName">Name</label>
				<input type="name" class="form-control" name="name" id="name" placeholder="{{$community->profile->name}}" value="{{$community->profile->name}}" required>
		  <label for="inputPassword">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="{{$community->profile->password}}", value="{{$community->profile->password}}" required>
		  <label for="inputEmail">Description</label>
				<input type="description" class="form-control" name="description" id="description" placeholder="{{$community->profile->description}}", value="{{$community->profile->description}}" required>
		  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Save profile info</button>
		  {{csrf_field()}}
	  </div>
	</form>
</div>
<button style="margin-top: 5px;" class="btn btn-primary" id="more_community" href="" onclick={{"show_hide_community(".$community->id.")"}} > Edit Community</button>
<script>
function show_hide_community(id) {
var community_id = "details_community_";
community_id = community_id.concat(id);
var x = document.getElementById(community_id);
if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
