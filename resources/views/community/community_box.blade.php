<div class="row" style="padding: 10px">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail shadow">
			<h3><font id='community_profile_name' color="black">{{ $community->profile->name }}</font></h3>
			<div class="caption">
				<p><font id='community_profile_description' color="black">{{ $community->profile->description }}</font></p>
				<div>
					@if(Auth::guard('profile')->user()->id == $community->user->profile->id)
					@include('community.edit_community_profile_form')
					@include('community.delete_community_button')
					@endif
					@include('community.show_community_button')
				</div>
			</div>
		</div>
	</div>
</div>
