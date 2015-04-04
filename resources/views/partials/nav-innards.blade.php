<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="hvr-grow nav-element navbar-brand" href="/">UASCasts</a>
	</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a class="hvr-grow nav-element nav-path" href="{{ url('/series') }}"><i class="fa fa-play-circle-o"></i> Series </a></li>
			<li><a class="hvr-grow nav-element nav-path" href="{{ action('VideoController@dashboard') }}"><i class="fa fa-connectdevelop"></i>
Videos</a></li>
			<li><a class="hvr-grow nav-element nav-path" href="{{ action('HardwareController@dashboard') }}"><i class="fa fa-paper-plane"></i>
Hardware</a></li>
		</ul>

		@if (Route::current()->getUri() == '/')
		@else
			<ul class="nav navbar-nav navbar-right material-design">
				@if (Auth::guest())
					<li><a href="{{ url('/auth/login') }}" class="hvr-grow">Log In</a></li>
					<li><a id="register-nav" class="ripple-effect btn-primary hvr-grow-shadow" href="{{ action('PagesController@plans') }}">Begin Learning</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->display_name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@if (Auth::user()->isAdmin())
								<li><a href="{{ action('Admin\AdminController@dashboard') }}">Admin</a></li>
							@endif
							<li><a href="{{ action('UserController@settings') }}">Settings</a></li>
							<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
		@endif
	</div>
</div>