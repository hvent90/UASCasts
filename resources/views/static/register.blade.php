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
    data-amount="9900"
    data-name="PX4Casts"
    data-description="Yearly subscription for $99"
    data-image="/128x128.png">
  </script>
</form>
<div class="register-container">
	<div class="plan-header">
		<h3>You'll be starting a free trial</h3>
	</div>
	<div class="register-form-wrapper">
		<div class="col-xs-12">
			{!! Form::open(['action' => 'UserController@store', 'id' => 'signup-form']) !!}
				<div class="btn-group btn-group-justified period-selectors" data-toggle="buttons">
					<label id="month-period-label" class="period-labels btn btn-primary">
						<input value="month" type="radio" name="period" id="month-radio" autocomplete="off">Month
					</label>
					<label id="year-period-label" class="period-labels btn btn-primary">
						<input value="year" type="radio" name="period" id="year-radio" autocomplete="off">Year
					</label>
				</div>
				<div class="register-form-container-featurette">
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
										<input type="number" name="age" placeholder="Age: *">
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

 					{!! Form::submit('Begin!', ['class' => 'hvr-grow-shadow', 'id' => 'login-button']) !!}
					<span id="secure"><i id="secure-icon" class="fa fa-lock"></i>
 Payment is handled securely with <a href="http://stripe.com"><i id="stripe-icon" class="fa fa-cc-stripe"></i></a></span>
 					<ul id="errors" class="hidden alert alert-danger">

 					</ul>
				</div>
			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

{{--
The most beautiful form to not exist. RIP
<hr>

<div class="col-xs-12 gdi">
	<fieldset class="form-division">
		<h3><span class="form-step">3</span>Payment Details</h3>
			<div class="row">
				<div class="form-item col-sm-6">
					{!! Form::label('card_number', 'Card Number: *') !!}
					{!! Form::text(null, null, ['placeholder' => 'Card Number: *']) !!}
				</div>
				<div class="form-item col-sm-4">
					{!! Form::label('zip', 'Postal/Zip: *') !!}
					{!! Form::text(null, null, ['placeholder' => 'Postal/Zip: *']) !!}
				</div>
				<div class="form-item col-sm-2">
					{!! Form::label('ccv', 'CCV: *') !!}
					{!! Form::text(null, null, ['placeholder' => 'CCV: *']) !!}
				</div>
			</div>
			<div class="row">
				<div class="form-item month-container age-check col-sm-6">
					<div class="col-xs-5">
						<p id="exp-date-psuedo-label">Expiration Date: *</p>
					</div>
					<div class="col-xs-7">
						{!! Form::label('age', 'Month: *') !!}
						<input type="month" placeholder="Expiration: *">
					</div>
				</div>
			</div>
	</fieldset>
</div> --}}


@section('scripts')
<script>
$('document').ready(function(){
	/**
	 * First we determine if the user selected Month or Year
	 * from the previous screen.
	 * @type {String}
	 */
	var period = '{{$period}}';

	/**
	 * And then we appropriately set which radio is selected
	 * at the top of the page.
	 * @type {[type]}
	 */
	var $radios = $('input:radio[name=period]');
	if(period == 'month') {
		$('#month-period-label').toggleClass('active');
		$radios.filter('[value=month]').prop('checked', true);
	} else {
		$('#year-period-label').toggleClass('active');
		$radios.filter('[value=year]').prop('checked', true);
	}

	/**
	 * When the user clicks 'Begin!', we need to first register the user.
	 * If the user properly is registered, then we can trigger the Stripe
	 * payment by automatically triggering a click event on a hidden
	 * embedded stripe form.
	 */
	$('#login-button').click(function(e) {
		e.preventDefault();

		/**
		 * First we grab all of the form inputs
		 * and throw it in a JavaScript object.
		 */
		var formData = {};
		$('#login-button').val('Creating your account...');

		$('#signup-form input').each(function() {
		    formData[this.name] = this.value;
		});

		if ($('.period-labels.active').attr('id') == 'month-period-label') {
			formData.period = 'month';
		} else {
			formData.period = 'year';
		}

		console.log(formData);

		/**
		 * Now we make an AJAX request to the backend.
		 * If the user is properly created, then we trigger
		 * the embedded stripe form.
		 *
		 * If it fails, then we show some errors babygirl.
		 */
		$.ajax({
			type: "POST",
			url: '/register',
			data: formData,
			success: function(data, textStatus, jqXHR) {
				$('#login-button').val('Account Created!');
				if(formData.period == 'month') {
					{{ Session::put('period', 'month') }}
					$('#stripe-month .stripe-button-el').trigger('click');
				} else {
					{{ Session::put('period', 'year') }}
					$('#stripe-year .stripe-button-el').trigger('click');
				}
			},
			error: function(data){
				$('#login-button').val('Begin!');
				$('#errors').removeClass('hidden');
				$('#errors').html('');
		        var errors = data.responseJSON;
		        for (var key in errors) {
					if (errors.hasOwnProperty(key)) {
						$('#errors').append('<p>'+errors[key]+'</p>');
					}
				}
		    }
		});
	});


});
</script>
@endsection