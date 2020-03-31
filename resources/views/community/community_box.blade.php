<div class="row" style="padding: 10px">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail shadow">
			<h3><font id='community_profile_name' color="black">{{ $community->profile->name }}</font></h3>
			<div class="caption">
				<p><font id='community_profile_description' color="black">{{ $community->profile->description }}</font></p>
				<div>
					@if(Auth::guard('profile')->user()->id == $community->manager_user_id)
					@include('community.edit_community_profile_form')
					@include('community.delete_community_button')
					@endif
					<form method="GET" action={{route('community.show', $community)}} accept-charset="UTF-8">
					<button type="submit" class="btn btn-primary">Go to community</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>