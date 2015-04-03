@extends('app')

@section('content')

<div class="register-container">
	<div class="plan-header">
		<h3>Enter your email address to reset your password.</h3>
	</div>
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif

	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="register-form-wrapper">
		<div class="col-xs-12">
			<div class="register-form-container-featurette">
				<div class="col-xs-12 gdi">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
						<fieldset class="form-division">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-item form-group">
								<label class="col-md-12 control-label">E-Mail Address</label>
								<div class="col-md-12">
									<input type="email" placeholder="Email Address: *" class="form-control" name="email" value="{{ old('email') }}">
								</div>
							</div>

							<div class="form-group form-item">
								<div class="col-md-12">
									<button type="submit" id="register-button" class="btn btn-primary">
										Send Reset Link
									</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
