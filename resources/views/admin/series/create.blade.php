@extends('admin')

@section('content')
<div class="register-container">
	<div class="plan-header">
		<h3>Perform Greatness</h3>
	</div>
	<div class="register-form-wrapper">
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
		<div class="col-xs-12">
			{!! Form::open([
				'action' => 'Admin\AdminSeriesController@store',
				'id' => 'signup-form',
				'files' => true
			]) !!}
				<div class="register-form-container-featurette">
					<div class="col-xs-12 gdi">
						<fieldset class="form-division">
							<h3><span class="form-step">1</span>Basic Info</h3>
							<div class="row">
								<div class="form-item col-sm-12">
									{!! Form::label('name', 'Title: *') !!}
									{!! Form::text('name', null, ['placeholder' => 'Title: *', 'class' => 'form-control']) !!}
								</div>
							</div>
							<div class="row">
								<div class="form-item col-sm-12 form-group">
									{!! Form::label('description', 'Description: *') !!}
									{!! Form::textarea('description', null, ['placeholder' => 'Description: *', 'class' => 'form-control']) !!}
								</div>
							</div>
						</fieldset>
					</div>

					<hr>

					<div class="col-xs-12 gdi">
						<fieldset class="form-division">
							<h3><span class="form-step">2</span>Media</h3>
							<div class="row">
								<div class="form-item month-container age-check col-sm-12">
									<div class="col-xs-5">
										<p id="exp-date-psuedo-label">Thumbnail Image: *</p>
									</div>
									<div class="col-xs-7">
										{!! Form::label('age', 'Month: *') !!}
										<input type="file" name="thumbnail_url" placeholder="Thumbnail Image: *">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-item col-sm-12 form-group">
									{!! Form::label('font_awesome', 'Font Awesome Icon: *') !!}
									{!! Form::text('font_awesome', null, ['placeholder' => 'Font Awesome Icon:', 'class' => 'form-control']) !!}
								</div>
							</div>
						</fieldset>
					</div>

 					{!! Form::submit('Create', ['id' => 'register-button']) !!}
				</div>
			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')
<script>
$('document').ready(function(){

});
</script>
@endsection