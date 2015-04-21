<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{!! csrf_token() !!}">
	<title>UASCasts</title>

	@include('partials.common-styles')
	<link href="{{ asset('/output/video-create.css') }}" rel="stylesheet">
	<style>
		#drop_zone {
	      border: 2px dashed #bbb;
	      -moz-border-radius: 5px;
	      -webkit-border-radius: 5px;
	      border-radius: 5px;
	      padding: 25px;
	      text-align: center;
	      font: 20pt bold 'Helvetica';
	      color: #bbb;
	    }
	</style>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="page">
	@include('partials.nav-admin')

	@yield('content')

	@include('partials.footer')

	<!-- Scripts -->
	@include('partials.common-scripts')
	<script src="/output/video-create.js"></script>

	@yield('scripts')
</body>
</html>
