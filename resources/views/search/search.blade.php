@extends('layouts.welcome_loggedin')

@section('content')
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				<h1 class="font-weight-bold">Search Nozy!</h1>
				<div class="form-group">
 					<input type="text" name="search" id="search" class="form-control" placeholder="Search communities, users, posts..." />
				</div>
				<h1><span id="testid"></span></h1>
        <h2 class="font-weight-bold">Communities</h2>
				<div id='community_thumbnails'></div>
				<h2 class="font-weight-bold">Users</h2>
				<div id='user_thumbnails'></div>
				<h2 class="font-weight-bold">Posts</h2>
				<div id='post_thumbnails'></div>
			</div>
		</div>
	</div>
</div>

<script>

$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('search.search') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
		 $('#testid').html('success');
		 $('#community_thumbnails').html(data.community_thumbnails);
		 $('#user_thumbnails').html(data.user_thumbnails);
		 $('#post_thumbnails').html(data.post_thumbnails);
		 //window.location.reload();
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});

</script>
@endsection
