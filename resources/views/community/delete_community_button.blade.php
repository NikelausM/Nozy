<!--show/hide form on button click-->
<form action={{route('community.destroy', $community)}} method="post">
	<input name="_method" type="hidden" value="delete">
	<button style="margin-top: 5px;" class="btn btn-primary" type="submit">Delete community</button>
	{{csrf_field()}}
</form>
