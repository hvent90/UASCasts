@extends('app')

@section('content')
<form action="" method="POST" class="hidden" class="stripe-pay" id="stripe-month">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_TPTlHBmqMsFDX0fm97leQRKi"
    data-amount="900"
    data-name="PX4Casts"
    data-description="Monthly subscription for $9"
    data-image="/128x128.png">
  </script>
</form>
<form action="" method="POST" class="hidden" class="stripe-pay" id="stripe-year">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_TPTlHBmqMsFDX0fm97leQRKi"
    data-amount="9000"
    data-name="PX4Casts"
    data-description="Yearly subscription for $90"
    data-image="/128x128.png">
  </script>
</form>
<div class="register-container">
	<div class="register-form-wrapper">
		<div class="col-xs-12">
			{!! Form::model(Auth::user(), ['action' => 'UserController@update', 'id' => 'signup-form']) !!}
				@if ( ! Auth::user()->hasPurchasedBefore() || Auth::user()->stripe_active == 0 )
					<div class="plan-header">
						<h2>Click a plan below to begin your subscription!</h2>
					</div>
					<div class="material-design btn-group btn-group-justified period-selectors" data-toggle="buttons">
						<label id="month-period-label-create" class="ripple-effect period-labels btn btn-primary">
							<input value="month" type="radio" name="period" id="month-radio" autocomplete="off">$9 per month
						</label>
						<label id="year-period-label-create" class="ripple-effect period-labels btn btn-primary">
							<input value="year" type="radio" name="period" id="year-radio" autocomplete="off">$90 per year
						</label>
					</div>
				@else
					<div class="plan-header">
						<h2>Welcome Back!</h2>
					</div>
				@endif
				<div class="register-form-container-featurette with-bottom-buttons">
					<div class="col-xs-12 gdi">
						<fieldset class="form-division">
							<h3><span class="form-step">1</span>Basic Info</h3>
							<div class="row">
								<div class="form-item col-sm-4">
									{!! Form::label('first_name', 'First Name: *') !!}
									{!! Form::text('first_name', null, ['placeholder' => 'First Name: *']) !!}
								</div>
								<div class="form-item col-sm-5">
									{!! Form::label('last_name', 'Last Name: *') !!}
									{!! Form::text('last_name', null, ['placeholder' => 'Last Name: *']) !!}
								</div>
								<div class="form-item age-check col-sm-3">
									<div class="age-container">
										{!! Form::label('age', 'Age: *') !!}
										<input type="number" name="age" placeholder="Age: *" value="{{ Auth::user()->age }}">
										{{-- {!! Form::number('age', null, ['placeholder' => 'Age: *']) !!} --}}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-item col-sm-6">
									{!! Form::label('display_name', 'Display Name:') !!}
									{!! Form::text('display_name', null, ['placeholder' => 'Display Name:']) !!}
								</div>
								<div class="form-item col-sm-6">
									{!! Form::label('company', 'Company Name:') !!}
									{!! Form::text('company', null, ['placeholder' => 'Company:']) !!}
								</div>
							</div>
						</fieldset>
					</div>

					<hr>

					<div class="col-xs-12 gdi">
						<fieldset class="form-division">
							<h3><span class="form-step">2</span>Account Credentials</h3>
							<div class="row">
								<div class="form-item col-sm-12">
									{!! Form::label('email', 'Your Email: *') !!}
									{!! Form::text('email', null, ['placeholder' => 'Your Email: *']) !!}
								</div>
							</div>
							<div class="row">
								<div class="form-item col-sm-12">
									{!! Form::label('password', 'Your Password: *') !!}
									{!! Form::password('password', ['placeholder' => 'Your Password: *']) !!}
								</div>
							</div>
							<div class="row">
								<div class="form-item col-sm-12">
									{!! Form::label('password_confirmation', 'Confirm Password: *') !!}
									{!! Form::password('password_confirmation', ['placeholder' => 'Confirm Password: *']) !!}
								</div>
							</div>
						</fieldset>
					</div>

					{{-- <button class="" id="register-button">Update</button> --}}
					<button class="ripple-effect hvr-grow-shadow" id="login-button">Update</button>

 					{!! Form::submit('Update', ['id' => 'real-slim-slady', 'class' => 'hidden']) !!}

 					<ul id="errors" class="hidden alert alert-danger">

 					</ul>
				</div>
			{!! Form::close() !!}
			@if( Auth::user()->stripe_active == 1 )
				{!! Form::open(['action' => 'UserController@update']) !!}
					<div class="material-design btn-group btn-group-justified period-selectors bottons-on-da-bottom" data-toggle="buttons">
						@if ( Auth::user()->getStripePlan() == 'month' )
							<label id="month-period-label-modify-disabled" class="disabled-period period-labels left-button btn btn-primary">
								<input value="month" type="radio" name="period" id="month-radio" autocomplete="off">You're subscribed at $9/month
							</label>
							<label id="year-period-label-modify" class="period-labels btn btn-primary ripple-effect">
								<input value="year" type="radio" name="period" id="year-radio" autocomplete="off">Switch to $9 per year
							</label>
						@else
							<label id="month-period-label-modify" class="period-labels left-button btn btn-primary ripple-effect">
								<input value="month" type="radio" name="period" id="month-radio" autocomplete="off">Switch to $9 per month
							</label>
							<label id="year-period-label-modify-disabled" class="disabled-period period-labels btn btn-primary">
								<input value="year" type="radio" name="period" id="year-radio" autocomplete="off">You're subscribed at $9/year
							</label>
						@endif
						<label id="cancel-period-label-modify" class="period-labels right-button btn btn-primary ripple-effect">
							<input value="cancel" type="radio" name="period" id="cancel-radio" autocomplete="off">Unsubscribe
						</label>
					</div>
						<input id="hidden-form-submit" type="submit" class="hidden" value="Update">
				{!! Form::close() !!}
			@else
				<div class="the-great-divide"></div>
			@endif
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script>
$('document').ready(function() {
	$('#login-button').click(function(e) {
		e.preventDefault();

		putSessionVariable('intent', 'Edit the user credentials',
			$('#real-slim-slady').trigger('click'));
	});

	$('#month-period-label-create').click(function() {
		putSessionVariable('intent', 'Charge the user',
			putSessionVariable('period', 'month',
				$('#stripe-month .stripe-button-el').trigger('click')
			)
		);
	});

	$('#year-period-label-create').click(function() {
		putSessionVariable('intent', 'Charge the user',
			putSessionVariable('period', 'year',
				$('#stripe-year .stripe-button-el').trigger('click')
			)
		);
	});

	$('#month-period-label-modify').click(function() {
		putSessionVariable('intent', 'Change the users plan',
			putSessionVariable('period', 'month',
				swal({
					title: "Confirm",
					text: "You are switching to the $9/month plan.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#9BF28D",
					confirmButtonText: "Yes, switch it!",
					closeOnConfirm: false
				}, function(){
					swal({
						title: "All aboard!",
						text: "Your subscription plan has been amended.",
						showCancelButton: false,
						type: "success"
					}, function() {
						$('#hidden-form-submit').trigger('click');
					});
				})
		));
	});
	$('#year-period-label-modify').click(function() {
		putSessionVariable('intent', 'Change the users plan',
			putSessionVariable('period', 'year',
				swal({
					title: "Confirm",
					text: "You are switching to the $9/month plan.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#9BF28D",
					confirmButtonText: "Yes, switch it!",
					closeOnConfirm: false
				}, function(){
					swal({
						title: "All aboard!",
						text: "Your subscription plan has been amended.",
						showCancelButton: false,
						type: "success"
					}, function() {
						$('#hidden-form-submit').trigger('click');
					});
				})
		));
	});


	$('#cancel-period-label-modify').click(function() {
		putSessionVariable('intent', 'Cancel the users subscription',
			swal({
				title: "Confirm",
				text: "You are cancelling your subscription to PX4Casts.",
				type: "error",
				showCancelButton: true,
				confirmButtonColor: "#F27474",
				confirmButtonText: "Yes, shut it down!",
				closeOnConfirm: false
			}, function() {
				$('#hidden-form-submit').trigger('click');
			})
		);
	});
});

</script>
@endsection