@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				<h1 class="font-weight-bold">Welcome to {{$community->profile->name}}</h1>
				<h2 class="font-weight-bold">Description: {{$community->profile->description}}</h2>

				@include('community.edit_community_profile_form')

				@foreach($community->profile->posts as $post)
				<div class="row" style="padding: 10px">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail shadow">
							<h3><font color="black">{{ $post->title }}</font></h3>
							<div class="caption">
								<p><font color="black">{{ $post->description }}</font></p>
								<div>
									<form method="GET" action={{route('post.showUserCommunityPost', [\App\User::where('profile_id', Auth::guard('profile')->user()->id)->first(), $community, $post])}} accept-charset="UTF-8">
										<button type="submit" class="btn btn-primary">Go to post</button>
										<!--{{ csrf_field() }}-->
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
