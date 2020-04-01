<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div>
<div style="overflow: scroll;max-height: 500px;">
@foreach(Auth::guard('profile')->user()->notifications as $notification)
<div class="container">
	<div class="row">
		<div class="col justify-content-md-center">
			<p>{{$notification->message}}</p>
		</div>
		<div class="col justify-content-md-center">
			@include('notification.delete_notification_button')
		</div>
	</div>
</div>
@endforeach
</div>
