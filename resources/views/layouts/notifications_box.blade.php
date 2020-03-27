<div class="row" style="padding: 10px">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail shadow">
			<h3><font color="black">{{ $notification->notification_type }}</font></h3>
				<div>
					<form method="POST" action={{route('notifications.delete', [$notification->id])}} accept-charset="UTF-8">
						<button type="submit" class="btn btn-primary">Dismiss</button>
					</form>
				</div>
		</div>
	</div>
</div>
