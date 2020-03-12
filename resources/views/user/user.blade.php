@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 25%;" class="col-12">
				<h1 class="font-weight-bold"><font color="black">Hello {{$user->name}}</font></h1>
				<h1 class="font-weight-bold"><font color="black">Your email is: {{$user->email}}</font></h1>
				<h1 class="font-weight-bold"><font color="black">Your description is: {{$user->profile->description}}</font></h1>
				<h2 class="font-weight-bold"><font color="black">Communities managed by you are:</font></h2>
				@foreach($communities as $community)
				<div class="row" style="padding: 10px">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail shadow">
							<h3><font color="black">{{ $community->profile->name }}</font></h3>
							<div class="caption">
								<p><font color="black">{{ $community->profile->description }}</font></p>
								<div>
								<form method="GET" action={{route('community.getCommunityView', [$user, $community])}} accept-charset="UTF-8">
									<button type="submit" class="btn btn-primary">Go to community</button>
									{{ csrf_field() }}
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
