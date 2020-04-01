
<!-----Website Header------>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<title>Nozy</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Oswald:400,600,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

// Trying to fix stuff
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" type="text/css">
<link rel="stylesheet" href="{{ URL::asset('css/g15.css') }}" type="text/css">

<?php Session::put('unique_id', 1); // Reset unique id used by tags?>
<!-- Styles -->
