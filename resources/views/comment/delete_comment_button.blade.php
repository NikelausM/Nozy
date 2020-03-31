<?php // Give the form a unique id ?>
<?php Session::put('unique_id', Session::get('unique_id') + 1) ?>
@if(Session::has("destroy_comment_error_".Session::get('unique_id')))
<?php $destroy_comment_error_id = Session::get("destroy_comment_error_".Session::get('unique_id')); ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($destroy_comment_error_id);?></font></div>
<?php Session::forget($destroy_comment_error_id) ?>
@endif

<!--show/hide form on button click-->
<form action={{route('comment.destroy', $comment->id)}} method="post">
	<input name="_method" type="hidden" value="delete">
	<div class="row-1">
		<div class="col-75" style="display: none;">
			<input class="form-control" type="number" id="comment_id" name="comment_id" value={{$comment->id}}>
		</div>
	</div>
	<div class="row-1">
		<div class="col-75" style="display: none;">
			<input type="number" id="unique_id" name="unique_id" value={{Session::get('unique_id')}}>
		</div>
	</div>
	<button style="margin-top: 5px;" class="btn btn-primary" type="submit">Delete comment</button>
	{{csrf_field()}}
</form>
