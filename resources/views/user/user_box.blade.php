<div class="row" style="padding: 10px">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail shadow">
			<h3><font color="black">{{ $user->profile->name }}</font></h3>
			<div class="caption">
				<p><font color="black">{{ $user->profile->description }}</font></p>
				<div>
					<form method="GET" action={{route('user.show', $user)}} accept-charset="UTF-8">
					<button type="submit" class="btn btn-primary">Go to user</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
