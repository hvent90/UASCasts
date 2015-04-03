@extends('app')

@section('content')
<div class="register-container">
	<div class="plan-header">
		<h3>Welcome Back!</h3>
	</div>
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
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<fieldset class="form-division">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-item form-group">
								<label class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-12">
									<input type="email" class="form-control" placeholder="Email Address: *" name="email" value="{{ old('email') }}">
								</div>
							</div>

							<div class="form-item form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-12">
									<input type="password" class="form-control" placeholder="Password: *" name="password">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="checkbox" id="remember-me">
										<label>
											<input type="checkbox" name="remember"> Remember Me
										</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<input type="submit" class="hvr-grow-shadow" id="login-button" class="">

									<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
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

@section('scripts')

@endsection