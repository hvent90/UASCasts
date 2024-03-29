<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="google-site-verification" content="KBUmqIRNrXUKP6u0kVllEtp0rbJf58bSJywmz4PnVtg" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UASCasts</title>

	@include('partials.common-styles')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="landing-body">
	@include('partials.nav-landing')

	@yield('content')

	@include('partials.footer')

	<!-- Scripts -->
	@include('partials.common-scripts')

	@yield('scripts')
</body>
</html>
