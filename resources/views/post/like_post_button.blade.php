
<form action={{route('post.like', $post)}} method="post" style="float:right;margin:5px">
	<button style="margin-top: 5px;" class="btn btn-primary" type="submit">Like post</button>
	{{csrf_field()}}
</form>
