@extends('admin-video')

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
				'action' => 'Admin\AdminVideoController@store',
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

							{{-- <div class="row">
								<div class="form-item col-sm-12">
									{!! Form::label('video_url', 'Vimeo URL: *') !!}
									{!! Form::text('video_url', null, ['placeholder' => 'Vimeo URL: *']) !!}
								</div>
							</div> --}}

							<div class="row">
								<div class="form-item col-sm-12 form-group">
									{!! Form::label('font_awesome', 'Font Awesome Icon: *') !!}
									{!! Form::text('font_awesome', null, ['placeholder' => 'Font Awesome Icon:', 'class' => 'form-control']) !!}
								</div>
							</div>

							<div class="bs-component">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Upload a Video</a></li>
									<li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Select a Video</a></li>
								</ul>
								<div id="myTabContent" class="tab-content">
									<div class="tab-pane fade active in" id="home">
										<div id="drop_zone">Drop files here</div>
										<br>
										<div class="progress">
											<div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
											0%
											</div>
										</div>
										<div id="results"></div>
									</div>
									<div class="tab-pane fade" id="profile">
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
									</div>
									<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div>
								</div>
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
												<ul id="series-order-list-{{$series->id}}"
													class="series-order-list">
													@foreach ($series->videos()->orderBy('series_video.order', 'asc')->get() as $video)
														<li data-id="{{ $video->id }}" id="{{ $video->id }}-"
															class="{{ $series->id }}"><span id="{{$video->id}}" class="{{$series->id}}"></span>
															<i class="fa fa-bars dull"></i>{{ $video->name }}</li>
													@endforeach
													<li data-id="thisvideo" id="thisvideo" class="draggable this-video"><span class="{{$series->id}}"></span><i class="fa fa-bars drag-handler"></i>This Video</li>
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
											<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</fieldset>
					</div>

					{!! Form::hidden('series', null, ['id' => 'series-input']) !!}

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
$('document').ready(function() {
	$('.video-labels').click(function() {
		$('.video-labels').each(function(label) {
			// $(label).removeClass('active');
		});

		// $(this).toggleClass('active');
	});

	$("#categories-input").select2({
		tags: true
	});

	var el = document.getElementById('items');

	var formData = {};
	var newFormData = {};

	$('.series-selector-name').click(function() {
		var seriesId = $(this).attr('id');

		$(this).toggleClass('selected');

		$('#series-' + seriesId).find('.series-order-list-container').toggleClass('hidden');

		if( $(this).hasClass('selected') ) {
			if( $('#series-' + seriesId).find('.first-video').text() ) {
				newFormData[seriesId] = ['thisvideo'];
				$('#series-input').val(JSON.stringify(newFormData));
			} else {
				var el = document.getElementById('series-order-list-' + seriesId);
				var sortable = new Sortable(el, {
					animation: 150,
					handle: ".draggable",
					onEnd: function (evt) {
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
							});
							newFormData[seriesId] = sortable.toArray();
							$('#series-input').val(JSON.stringify(newFormData));
						}
					}
				});
			}
		} else {
			$('#series-' + seriesId).find('input').prop('checked', false);
			delete newFormData[seriesId];
			$('#series-input').val(JSON.stringify(newFormData));
		}
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

/**
* Called when files are dropped on to the drop target. For each file,
* uploads the content to Drive & displays the results when complete.
*/
function handleFileSelect(evt) {
 evt.stopPropagation();
 evt.preventDefault();
 var files = evt.dataTransfer.files; // FileList object.
 var accessToken = 'f5f0f2ab9682194687abf2ffa487a202';
 var upgrade_to_1080 = 'yes';

 // Clear the results div
 var node = document.getElementById('results');
 while (node.hasChildNodes()) node.removeChild(node.firstChild);

 // Reset the progress bar
 updateProgress(0);

 var uploader = new MediaUploader({
     file: files[0],
     token: accessToken,
     upgrade_to_1080: upgrade_to_1080,
     onError: function(data) {

        var errorResponse = JSON.parse(data);
        message = errorResponse.error;

        var element = document.createElement("div");
        element.setAttribute('class', "alert alert-danger");
        element.appendChild(document.createTextNode(message));
        document.getElementById('results').appendChild(element);

     },
     onProgress: function(data) {
        updateProgress(data.loaded / data.total);
     },
     onComplete: function(videoId) {
     	$('input[name=video]').val('');

     	var videoFormData = {
			uri: 'upload',
			id: videoId
		};

		$('input[name=video]').val(JSON.stringify(videoFormData));

        // var url = "https://vimeo.com/"+videoId;

        // var a = document.createElement('a');
        // a.appendChild(document.createTextNode(url));
        // a.setAttribute('href',url);

        // var element = document.createElement("div");
        // element.setAttribute('class', "alert alert-success");
        // element.appendChild(a);

        // document.getElementById('results').appendChild(element);
     }
 });
 uploader.upload();
}

/**
* Dragover handler to set the drop effect.
*/
function handleDragOver(evt) {
 evt.stopPropagation();
 evt.preventDefault();
 evt.dataTransfer.dropEffect = 'copy';
}

/**
* Wire up drag & drop listeners once page loads
*/
document.addEventListener('DOMContentLoaded', function () {
   var dropZone = document.getElementById('drop_zone');
   dropZone.addEventListener('dragover', handleDragOver, false);
   dropZone.addEventListener('drop', handleFileSelect, false);
});
;
/**
* Updat progress bar.
*/
function updateProgress(progress) {
  progress = Math.floor(progress * 100);
  var element = document.getElementById('progress');
  element.setAttribute('style', 'width:'+progress+'%');
  element.innerHTML = progress+'%';
}

progress
</script>
@endsection