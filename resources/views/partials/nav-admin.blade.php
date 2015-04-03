<nav id="standard-nav" class="navbar navbar-default">
	@include('partials.nav-innards')
</nav>

{{-- <nav class="secondary-nav">
    <div class="container">
        <ul class="zeroed secondary-nav--left">

            <!-- Browse -->
            <li class="dropdown ">
                <a href="/index" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                    Browse <b class="caret"></b>
                </a>

                <ul class="dropdown-menu">
                    <li class=""><a href="/index">Site Index</a></li>
                    <li><a href="/all">Latest Content</a></li>
                </ul>
            </li>

            <!-- Recommended Reading -->
            <li id="navbar-link--recommended-reading" class="">
                <a class="navbar-link" href="/recommended-reading">Recommended Reading</a>
            </li>
            <li>
                <div id="navbar-search-form">
                    <form role="search" action="/search" method="GET">
                        <i class="fa fa-search"></i>
                        <input type="text" id="q" name="q" placeholder="Search PX4Casts">

                        <select name="q-where" id="q-where" class="hide">
                            <option value="lessons">Lessons</option>
                            <option value="forum">Forum</option>
                        </select>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav> --}}
<nav class="secondary-nav" id="nav-admin">
    <div class="container">
        <ul class="zeroed secondary-nav--left">

            <li class="dropdown ">
                <a href="/index" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                    Videos <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li class=""><a href="{{ action('Admin\AdminVideoController@dashboard') }}">Index</a></li>
                    <li><a href="{{ action('Admin\AdminVideoController@create') }}">Create New</a></li>
                </ul>
            </li>

            <li class="dropdown ">
                <a href="/index" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                    Series <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li class=""><a href="{{ action('Admin\AdminSeriesController@dashboard') }}">Index</a></li>
                    <li><a href="{{ action('Admin\AdminSeriesController@create') }}">Create New</a></li>
                </ul>
            </li>

            <li class="dropdown ">
                <a href="/index" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                    Hardware <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li class=""><a href="{{ action('Admin\AdminHardwareController@dashboard') }}">Index</a></li>
                    <li><a href="{{ action('Admin\AdminHardwareController@create') }}">Create New</a></li>
                </ul>
            </li>

            @if( Auth::user()->isSuperAdmin())
	            <li class="dropdown ">
	                <a href="/index" class="navbar-link dropdown-toggle" data-toggle="dropdown">
	                    Users <b class="caret"></b>
	                </a>
	                <ul class="dropdown-menu">
	                    <li class=""><a href="/index">Index</a></li>
	                    <li><a href="/all">Create New</a></li>
	                </ul>
	            </li>
	        @endif
        </ul>
    </div>
</nav>