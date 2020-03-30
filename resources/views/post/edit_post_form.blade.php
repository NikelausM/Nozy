<!--Print out any errors with form inputs-->
@if(count($errors)>0)
<div class="alert alert-danger">
		@foreach($errors->all() as $error)
			<p><font color = "red">{{$error}}</font></p>
		@endforeach
	</div>
@endif
<!--show/hide form on button click-->
<div id={{"details_post_".$post->id}} style="display:none">
	<form action={{route('post.update', $post)}} method="post">
	  <div class="form-group">
		  <label for="inputName">Subject</label>
				<input type="name" class="form-control" name="subject" id="subject" placeholder="{{$post->subject}}" value="{{$post->subject}}">
		  <label for="inputEmail">Body</label>
				<input type="description" class="form-control" name="body" id="body" placeholder="{{$post->body}}", value="{{$post->body}}">
		  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Save post</button>
		  {{csrf_field()}}
	  </div>
	</form>
</div>
<button style="margin-top: 5px;" class="btn btn-primary" id="more_post" href="" onclick={{"show_hide_post(".$post->id.")"}} > Edit Post</button>
<script>
function show_hide_post(id) {
var post_id = "details_post_";
post_id = post_id.concat(id);
var x = document.getElementById(post_id);
if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
