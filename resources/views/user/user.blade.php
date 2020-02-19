@extends('layouts.welcome')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<div class="row h-100 align-items-center">
			<div style="top: 5%;" class="col-12">
				<h1 class="font-weight-bold"><font color="black">Hello {{$name}}</font></h1>
				<h1 class="font-weight-bold"><font color="black">Your email is: {{$user->email}}</font></h1>
			</div>
		</div>
	</div>
</div>
@endsection
