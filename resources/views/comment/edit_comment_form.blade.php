<?php // Give the form a unique id ?>
@if(Session::has('unique_id'))
{{Session::put('unique_id', Session::get('unique_id') + 1)}}
@else
{{Session::put('unique_id', 1)}}
@endif
@if(Illuminate\Support\Facades\Session::has("update_comment_error_".Session::get('unique_id')))
<?php $update_comment_error_id = Session::get("update_comment_error_".Session::get('unique_id')) ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($update_comment_error_id);?></font></div>
{{Session::forget($update_comment_error_id)}}
@if(count($errors->updateCommentErrors)>0)
<div class="alert alert-danger">
		@foreach($errors->updateCommentErrors->all() as $error)
			<p><font color = "red">{{$error}}</font></p>
		@endforeach
	</div>
@endif
@endif
<!--show/hide form on button click-->
<div id={{"details_comment_".$comment->id}} style="display:none">
	<form action={{route('comment.update', $comment->id)}} method="post">
	  <div class="form-group">
			<div class="row-1">
        <div class="col-75" style="display: none;">
          <input type="number" id="unique_id" name="unique_id" value={{Session::get('unique_id')}}>
        </div>
      </div>
			<div class="row-1">
				<div class="col-75" style="display: none;">
					<input class="form-control" type="number" id="comment_id" name="comment_id" value={{$comment->id}}>
				</div>
			</div>
      <div class="row-1">
        <div class="col-75" style="display: none;">
          <input class="form-control" type="number" id="post_id" name="post_id" value={{$comment->post_id}}>
        </div>
      </div>
      <div class="row-1">
        <div class="col-75" style="display: none;">
          <input class="form-control" type="number" id="user_id" name="user_id" value={{$comment->user_id}}>
        </div>
      </div>
      <div class="row-1">
        <div class="col-75">
          <input class="form-control" type="text" id="body" name="body" placeholder="Enter comment...">
        </div>
      </div>
      <div class="row-1">
        <div class="col-75" style="display: none;">
          <input class="form-control" type="number" id="parent_id" name="parent_id" value={{$comment->parent_id}}>
        </div>
	    </div>
		  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Save comment</button>
		  {{csrf_field()}}
	  </div>
	</form>
</div>
<button style="margin-top: 5px;" class="btn btn-primary" id="more_commment_edit_form" href="" onclick={{"show_hide_comment_edit_form(".$comment->id.")"}} > Edit comment</button>
<script>
function show_hide_comment_edit_form(id) {
var comment_id = "details_comment_";
comment_id = comment_id.concat(id);
var x = document.getElementById(comment_id);
if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
