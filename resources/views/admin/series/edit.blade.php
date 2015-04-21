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
			{!! Form::model($series, [
				'action' => ['Admin\AdminSeriesController@update', $series->id],
				'id' => 'signup-form',
				'files' => true
			]) !!}
				<div class="register-form-container-featurette">
					<div class="col-xs-12 gdi">
						<fieldset class="form-division">
							<h3><span class="form-step">1</span>Basic Info</h3>
							<div class="row">
								<div class="form-group col-sm-12 disregard-form-styles form-group">
									{!! Form::label('featured', 'Is this series Featured? ') !!}
									{!! Form::checkbox('featured', null, null, ['placeholder' => 'Is this series Featured?']) !!}
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
							<div class="row">
								<div class="form-item col-sm-12 form-group">
									{!! Form::label('font_awesome', 'Font Awesome Icon: *') !!}
									{!! Form::text('font_awesome', null, ['placeholder' => 'Font Awesome Icon:', 'class' => 'form-control']) !!}
								</div>
							</div>
						</fieldset>
					</div>

					<hr>

					<div class="col-xs-12 gdi">
						<fieldset class="form-division video-list">
							<h3><span class="form-step">3</span>Videos</h3>
							<div class="row">
								<div class="col-xs-6">
									<div class="awesome-panel with-header">
										<div class="awesome-panel-header">
											<h3>Videos in This Series</h3>
										</div>
										<div class="awesome-panel-body-no-footer">
											<ul id="included-videos"
												class="series-order-list">
												@foreach ($series->videos()->orderBy('series_video.order', 'asc')->get() as $video)
													<li data-id="{{ $video->id }}" id="{{ $video->id }}" class="draggable this-video"><span class="{{$series->id}}"></span><i class="fa fa-bars drag-handler"></i>{{ $video->name }}</li>
												@endforeach
											</ul>
										</div>
									</div>
								</div>

								<div class="col-xs-6">
									<div class="awesome-panel with-header">
										<div class="awesome-panel-header">
											<h3>Excluded Videos</h3>
										</div>
										<div class="awesome-panel-body-no-footer">
											<ul id="excluded-videos"
												class="series-order-list">
												@foreach ($allVideos as $video)
													<li data-id="{{ $video->id }}" id="{{ $video->id }}" class="draggable this-video"><span class="{{$series->id}}"></span><i class="fa fa-bars drag-handler"></i>{{ $video->name }}</li>
												@endforeach
											</ul>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</div>

					{!! Form::hidden('series-id', $series->id) !!}
					{!! Form::hidden('series', null, ['id' => 'series-input']) !!}

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
$('document').ready(function(){
	var newFormData = {};
	var includedVideos = document.getElementById('included-videos');
	var excludedVideos = document.getElementById('excluded-videos');

	var sortableIncluded = new Sortable(includedVideos, {
		group: "videos",
		animation: 150,
		store: {
	        /**
	         * Get the order of elements. Called once during initialization.
	         * @param   {Sortable}  sortable
	         * @returns {Array}
	         */
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

	        /**
	         * Save the order of elements. Called onEnd (when the item is dropped).
	         * @param {Sortable}  sortable
	         */
	        set: function (sortable) {
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

	            var order = sortable.toArray();
	            localStorage.setItem(sortable.options.group, order.join('|'));
	        }
	    },
	    // Element is dropped into the list from another list
		onAdd: function (evt) {
		    var seriesId = '';
		    var itemEl = evt.item;  // dragged HTMLElement
		    console.log(itemEl);

			Object.keys(sortableIncluded.el.children).some(function(key) {
				if (key == 'length') {
					return true;
				}
				seriesId = $(sortableIncluded.el.children[key]).find('span').attr('class');
				// var data = $(sortable.el.children[key]).attr('id');

				// $(sortable.el.children[key]).attr('data-id', data+key);
			});
			newFormData[seriesId] = sortableIncluded.toArray();
			$('#series-input').val(JSON.stringify(newFormData));
		}
	});

	var sortableExcluded = new Sortable(excludedVideos, {
		group: "videos",
		animation: 150
	});
});
</script>
@endsection