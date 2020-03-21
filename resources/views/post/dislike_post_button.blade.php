<!--show/hide form on button click-->
<form action={{route('post.dislike', $post)}} method="post" style="float:right"> <!-- I don't know how to make this not float so far right-->
	<button style="margin-top: 5px;" class="btn btn-primary" type="submit">Dislike post</button>
	{{csrf_field()}}
</form>
