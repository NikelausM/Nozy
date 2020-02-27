@extends('layouts.welcome_signedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-50 align-items-center">
			<div style="top: 5%;" class="col-12">
				<h1 class="font-weight-bold">Welcome to {{$community->name}}</h2>
				<h2 class="font-weight-bold">Description: {{$community->profile->description}}</h2>
			</div>
		</div>
	</div>
</div>
@endsection
