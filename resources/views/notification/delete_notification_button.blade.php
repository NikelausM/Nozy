<form action={{route('notifications.destroy', $notification)}} method="post" style="margin-top:10px">
	<input name="_method" type="hidden" value="delete">
	<button class="btn btn-primary" type="submit">Delete notification</button>
	{{csrf_field()}}
</form>
