@extends('app')

@section('content')

<div class="plan-container">
	<div class="plan-header">
		<h2>How Driven Are You?</h2>
	</div>
	<div class="col-sm-6 pricing-container">
		<div class="plan force-block" id="month-plan">
			<div class="plan-header">
				<h3 class="period-header-plan">Monthly</h3>
				<span>$14/<small>month</small></span>
			</div>
			<ul class="fa-ul plan-features">
				<li><i class="fa-li fa fa-check-square"></i>Feature bla bla bla</li>
				<li><i class="fa-li fa fa-check-square"></i>Feature bla bla bla</li>
				<li><i class="fa-li fa fa-check-square"></i>Feature bla bla bla</li>
			</ul>
			<div class="plan-cta">
				<a href="{{ action('UserController@register', 'month') }}" class="hvr-grow-shadow hvr-shutter-out-horizontal-color btn">Start your free 14 day trial</a>
			</div>
		</div>
	</div>
	<div class="col-sm-6 pricing-container">
		<div class="plan" id="year-plan">
			<div class="plan-header">
				<h3 class="period-header-plan">Yearly</h3>
				<span>$140/<small>year</small></span>
			</div>
			<ul class="fa-ul plan-features">
				<li><i class="fa-li fa fa-check-square"></i>Feature bla bla bla</li>
				<li><i class="fa-li fa fa-check-square"></i>Feature bla bla bla</li>
				<li><i class="fa-li fa fa-check-square"></i>Feature bla bla bla</li>
				<li><i class="fa-li fa fa-check-square"></i>Feature bla bla bla</li>
				<li><i class="fa-li fa fa-check-square"></i>Feature bla bla bla</li>
			</ul>
			<div class="plan-cta force-block">
				<a href="{{ action('UserController@register', 'year') }}" class="hvr-grow-shadow hvr-shutter-out-horizontal-color btn">Start your free 14 day trial</a>
			</div>
		</div>
	</div>
</div>

@endsection