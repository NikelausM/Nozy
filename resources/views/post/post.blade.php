@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				<h1 class="font-weight-bold">Post: {{$post->subject}}</h1>
				<p class="font-weight-bold">Rating: {{$post->rating}}</p>
				<p class="font-weight-bold">Description: {{$post->body}}</p>
				<div class="row" style="padding: 10px"><!--row-->
					<!--you can put another foreach loop here to show replies in the next column (shifted to the right)-->
					<div class="col-sm-6 col-md-4"><!--column-->
						<div class="thumbnail shadow">
							<h3><font color="black">Comment description: </font></h3>
							<div class="caption">
								<p><font color="black">Comment rating: </font></p>
								<div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
