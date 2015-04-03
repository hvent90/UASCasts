@extends('admin')

@section('content')

<div class="container">
	@foreach($allSeries as $series)
	<div class="series-container row featured-videos">
		<div class="col-md-4">
			<div class="featured-video" id="{{ $series->id }}-container" style="background: url({{ $series->thumbnail_url }}-bw.jpg);">
				<div class="lesson-block-thumbnail">
		            <i class="fa fa-{{ $series->font_awesome }}"></i>
		        </div>
		        {{-- <h5 class="lesson-block-difficulty"> --}}
				{{-- </h5> --}}
				<h3 class="lesson-block-title  not-watched">
					<a href="#" title="">{{ $series->name }}</a>
				</h3>
				<a href="/olympus/series/edit/{{ $series->id }}" class="media-tile-module">Edit</a>
			    <a href="#" id="{{ $series->id }}"class="delete-the-series media-tile-module">Delete</a>
				{!! Form::model($series, [
					'method' => 'DELETE',
					'action' => ['Admin\AdminSeriesController@delete', $series->id],
					'class'  => 'delete-form'
				]) !!}
					{!! Form::submit('Delete', ['class' => 'hidden destroyit']) !!}
				{!! Form::close() !!}
				<small class="lesson-block-length">
				</small>
			</div>
			<div class="lesson-block-excerpt">
			    <p>{{ $series->description }}</p>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="awesome-panel with-header">
					<div class="awesome-panel-header">
						<h3>Required Equipment</h3>
					</div>
					<div class="awesome-panel-body-no-footer">
						@for($i = 0; $i < 3; $i++)
							<div class="equipment-tile row">
								<div class="col-xs-2 equipment-tile-image" style="background-image: url(http://lorempixel.com/400/200/)">
									<p>1x</p>
								</div>
								<div class="col-xs-10 equipment-tile-name">
									<h4>Equipment Name</h4>
								</div>
							</div>
						@endfor
					</div>
				</div>
			</div>
			<div class="row">
				<div class="awesome-panel with-header">
					<div class="awesome-panel-header">
						<h3>Video Lessons</h3>
					</div>
					<div class="awesome-panel-body-no-footer">
						@foreach ($series->videos()->orderBy('series_video.order', 'asc')->get() as $video)
							<div class="equipment-tile row">
								<div class="col-xs-2 equipment-tile-image" style="background-image: url({{ $video->thumbnail_url }}-bw.jpg)">
									<p>&nbsp</p>
								</div>
								<div class="col-xs-10 equipment-tile-name">
									<h4>{{ $video->name }}</h4>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection

@section('scripts')
<script>
	$('.delete-the-series').click(function(e) {
		e.preventDefault();
		var seriesId = $(this).attr('id');
		console.log(seriesId);

		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this series!",
			type: "error",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false
		}, function(){
			$('#'+seriesId+'-container').find('.destroyit').trigger('click');
		});
	});
</script>
@endsection