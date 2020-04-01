
<form action={{route('post.dislike', $post)}} method="post" style="float:right;margin:5px">
	<button style="margin-top: 5px;" class="btn btn-primary" type="submit">Dislike post</button>
	{{csrf_field()}}
</form>
