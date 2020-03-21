<!--show/hide form on button click-->
<form action={{route('post.like', $post)}} method="post" style="float:right"> <!-- I don't know how to make this not float so far right-->
	<button style="margin-top: 5px;" class="btn btn-primary" type="submit">Like post</button>
	{{csrf_field()}}
</form>
