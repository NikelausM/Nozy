<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div>
<div style="overflow: scroll;max-height: 500px;">
@foreach(Auth::guard('profile')->user()->notifications as $notification)
	<p style="text-align: center">{{$notification->message}}</p>
@endforeach
</div>
