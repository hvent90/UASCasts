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
			{!! Form::model($video, [
				'action' => 'Admin\AdminVideoController@update',
				'id' => 'signup-form',
				'files' => true])
			!!}
				<div class="register-form-container-featurette">
					<div class="col-xs-12 gdi">
						<fieldset class="form-division">
							<h3><span class="form-step">1</span>Basic Info</h3>
							<div class="row">
								<div class="form-group col-sm-12 disregard-form-styles form-group">
									{!! Form::label('free', 'Is this video Free? ') !!}
									{!! Form::checkbox('free', null, null, ['placeholder' => 'Is this video Free?']) !!}
								</div>
							</div>
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

					{{-- <div class="col-xs-12 gdi">
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
								<div class="form-item col-sm-12">
									{!! Form::label('video_url', 'Vimeo URL: *') !!}
									{!! Form::text('video_url', null, ['placeholder' => 'Vimeo URL: *']) !!}
								</div>
							</div>

							<div class="row">
								<div class="form-item col-sm-12 form-group">
									{!! Form::label('font_awesome', 'Font Awesome Icon: *') !!}
									{!! Form::text('font_awesome', null, ['placeholder' => 'Font Awesome Icon:', 'class' => 'form-control']) !!}
								</div>
							</div>
						</fieldset>
					</div> --}}

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

							<div class="video-selector-container">
								@foreach($vimeoVideos as $vimeoVideo)
									<div class="video-selector">
										<div id="{{ $vimeoVideo['uri'] }}" class="video-selector-name">
											<h4>{{ $vimeoVideo['name'] }}</h4>
											<span class="uri">{{ $vimeoVideo['uri'] }}</span>
											<span class="link">{{ $vimeoVideo['link'] }}</span>
											<span class="video_url_hd">{{ $vimeoVideo['video_url_hd'] }}</span>
											<span class="video_url_sd">{{ $vimeoVideo['video_url_sd'] }}</span>
											<span class="duration">{{ $vimeoVideo['duration'] }}</span>
										</div>
										<span class="vimeo-link">
											<a href="{{ $vimeoVideo['link'] }}">VIMEO</a>
										</span>
									</div>
								@endforeach
							</div>
							{!! Form::hidden('video') !!}
						</fieldset>
					</div>

					<hr>

					<div class="col-xs-12 gdi">
						<fieldset class="form-division">
							<h3><span class="form-step">3</span>Series</h3>
							<div class="row">
								<div class="col-sm-12 series-selector-container">
								@foreach ($allSeries as $series)
									<div id="series-{{ $series->id }}" class="series-selector">
										<div class="row">
											<div id="{{ $series->id }}" class="series-selector-name">
												<h4>{{ $series->name }}</h4>
											</div>
										</div>
										<div class="series-order-list-container row hidden">
											@if ($series->videos()->count() > 0)
												<span id="series-order-list-count-{{$series->id}}" class="{{ $series->videos()->count() }}">
												<ul id="series-order-list-{{$series->id}}"
													class="series-order-list">
													@foreach ($series->videos()->orderBy('series_video.order', 'asc')->get() as $videoInSeries)
														@if ($videoInSeries->id == $video->id)
															<li data-id="{{ $videoInSeries->id }}" id="{{ $videoInSeries->id }}"
															class="{{ $series->id }} draggable"><span id="{{$videoInSeries->id}}" class="{{$series->id}}"></span>
															<i class="fa fa-bars drag-handler"></i>This Video</li>
														@else
															<li data-id="{{ $videoInSeries->id }}" id="{{ $videoInSeries->id }}"
															class="{{ $series->id }}"><span id="{{$videoInSeries->id}}" class="{{$series->id}}"></span>
															<i class="fa fa-bars dull"></i>{{ $videoInSeries->name }}</li>
														@endif
														@if (! $video->series->contains($series->id))
															<li data-id="{{$video->id}}" id="{{$video->id}}" class="draggable this-video"><span class="{{$series->id}}"></span><i class="fa fa-bars drag-handler"></i>This Video</li>
														@endif
													@endforeach
												</ul>
											@else
												<h4 class="first-video">This will be the first video in the series.</h4>
											@endif
										</div>
									</div>
								@endforeach
								</div>
							</div>
						</fieldset>
					</div>

					<hr>

					<div class="col-xs-12 gdi">
						<fieldset class="form-division">
							<h3><span class="form-step">4</span>Categories</h3>
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('categories', 'Categories:') !!}
									<select name="categories[]" id="categories-input" class="form-control" multiple>
										@foreach ($categories as $category)
											<option @if($video->categories->contains($category)) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
								</div>
							</div>

						</fieldset>
					</div>

					{!! Form::hidden('series', null, ['id' => 'series-input']) !!}
					{!! Form::hidden('video-id', $video->id) !!}

 					{!! Form::submit('Update', ['id' => 'register-button']) !!}
				</div>
			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')
<script>
$('document').ready(function() {
	$("#categories-input").select2({
		tags: true
	});

	var formData = {};
	var newFormData = {};
	var preexistingVideoId = {{ $video->id }};
	var preexistingVideoUri = '{{ $video->vimeo_uri }}';

	var preexistingAttachedSeries = new Array();;
	@foreach ($video->series()->get() as $series) {
		preexistingAttachedSeries.push( {{$series->id}} );
	}
	@endforeach

	$('.video-selector-name').each(function(i, obj) {
		var videoUri = $(obj).find('span.uri').text();

		if (videoUri == preexistingVideoUri) {
			$(obj).addClass('selected');
		}
	});

	preexistingAttachedSeries.forEach(function(seriesId) {
		$('#' + seriesId).toggleClass('selected preexisting');

		var el = document.getElementById('series-order-list-' + seriesId);
		var sortable = new Sortable(el, {
			animation: 150,
			onEnd: function (evt) {
				formData[seriesId] = evt.newIndex;
				// $('#series-input').val(JSON.stringify(formData));
				console.log(formData);
		    },
		    store: {
			// Sorting acquisition (called during initialization)
				get: function (sortable) {
					console.log(sortable);
					var order = localStorage.getItem(sortable.options.group);
					var seriesId = '';

					Object.keys(sortable.el.children).some(function(key) {
						if (key == 'length') {
							return true;
						}
						seriesId = $(sortable.el.children[key]).find('span').attr('class');
						// var data = $(sortable.el.children[key]).attr('id');

						// $(sortable.el.children[key]).attr('data-id', data+key);
					});
					newFormData[seriesId] = sortable.toArray();
					$('#series-input').val(JSON.stringify(newFormData));

					return [];
				},

				// Saving the acquired sorting (called each time upon sorting modification)
				set: function (sortable) {
					var order = sortable.toArray();
					localStorage.setItem(sortable.options.group, order.join('|'));

					var seriesId = '';

					Object.keys(sortable.el.children).some(function(key) {
						if (key == 'length') {
							return true;
						}
						seriesId = $(sortable.el.children[key]).find('span').attr('class');
						// var data = $(sortable.el.children[key]).attr('id');

						// $(sortable.el.children[key]).attr('data-id', data+key);
					});
					newFormData[seriesId] = sortable.toArray();
					$('#series-input').val(JSON.stringify(newFormData));
				}
			}
		});

		$('#series-' + seriesId).find('.series-order-list-container').toggleClass('hidden');
	});

	$('.series-selector-name').click(function() {
		var seriesId = $(this).attr('id');

		$(this).toggleClass('selected');

		$('#series-' + seriesId).find('.series-order-list-container').toggleClass('hidden');

		if( $(this).hasClass('selected') ) {
			if( $('#series-' + seriesId).find('.first-video').text() ) {
				formData[seriesId] = 0;
				newFormData[seriesId] = [preexistingVideoId];
				$('#series-input').val(JSON.stringify(newFormData));
			} else {
				formData[seriesId] = $('#series-' + seriesId).find('span').attr('class');
				// $('#series-input').val(JSON.stringify(formData));
				console.log(formData);

				var el = document.getElementById('series-order-list-' + seriesId);
				var sortable = new Sortable(el, {
					animation: 150,
					onEnd: function (evt) {
						formData[seriesId] = evt.newIndex;
						// $('#series-input').val(JSON.stringify(formData));
						console.log(formData);
				    },
				    store: {
					// Sorting acquisition (called during initialization)
						get: function (sortable) {
							var order = localStorage.getItem(sortable.options.group);
							var seriesId = '';

							Object.keys(sortable.el.children).some(function(key) {
								if (key == 'length') {
									return true;
								}
								seriesId = $(sortable.el.children[key]).find('span').attr('class');
								// var data = $(sortable.el.children[key]).attr('id');

								// $(sortable.el.children[key]).attr('data-id', data+key);
							});
							newFormData[seriesId] = sortable.toArray();
							$('#series-input').val(JSON.stringify(newFormData));

							return [];
						},

						// Saving the acquired sorting (called each time upon sorting modification)
						set: function (sortable) {
							var order = sortable.toArray();
							localStorage.setItem(sortable.options.group, order.join('|'));

							var seriesId = '';

							Object.keys(sortable.el.children).some(function(key) {
								if (key == 'length') {
									return true;
								}
								seriesId = $(sortable.el.children[key]).find('span').attr('class');
								// var data = $(sortable.el.children[key]).attr('id');

								// $(sortable.el.children[key]).attr('data-id', data+key);
							});
							newFormData[seriesId] = sortable.toArray();
							$('#series-input').val(JSON.stringify(newFormData));
						}
					}
				});
			}
		} else {
			$('#series-' + seriesId).find('input').prop('checked', false);

			if ( $('#' + seriesId).hasClass('preexisting') ) {
				newFormData[seriesId] = 'remove';
				$('#series-input').val(JSON.stringify(newFormData));
			} else {
				delete newFormData[seriesId];
				$('#series-input').val(JSON.stringify(newFormData));
			}
		}

		console.log(formData);
	});

	$('.video-selector-name').click(function() {
		$('input[name=video]').val('');

		$('.video-selector-name').each(function(i, obj) {
			$(obj).removeClass('selected');
		});

		$(this).addClass('selected');

		var videoFormData = {
			uri: $(this).find('span.uri').text(),
			link: $(this).find('span.link').text(),
			duration: $(this).find('span.duration').text(),
			video_url_sd: $(this).find('span.video_url_sd').text(),
			video_url_hd: $(this).find('span.video_url_hd').text()
		};

		$('input[name=video]').val(JSON.stringify(videoFormData));
	});
});
</script>
@endsection