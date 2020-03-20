<!--show/hide form on button click-->
<form action={{route('post.destroy', $post)}} method="post">
	<input name="_method" type="hidden" value="delete">
	<button style="margin-top: 5px;" class="btn btn-primary" type="submit">Delete post</button>
	{{csrf_field()}}
</form>
