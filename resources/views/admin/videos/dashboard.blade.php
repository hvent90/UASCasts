@extends('admin')

@section('content')

<div class="container">
	<div class="row featured-videos">
	@foreach($allVideos as $video)
		<div class="col-md-4">
			<div class="featured-video" id="{{ $video->id }}-container" style="background: url({{ $video->thumbnail_url }}-bw.jpg);">
				<div class="lesson-block-thumbnail">
		            <i class="fa fa-{{ $video->font_awesome }}"></i>
		        </div>
		        {{-- <h5 class="lesson-block-difficulty"> --}}
				{{-- </h5> --}}
				<h3 class="lesson-block-title  not-watched">
					<a href="#" title="">{{ $video->name }}</a>
				</h3>
				<a href="/olympus/videos/edit/{{ $video->id }}" class="media-tile-module">Edit</a>
			    <a href="#" id="{{ $video->id }}"class="delete-the-video media-tile-module">Delete</a>
				{!! Form::model($video, [
					'method' => 'DELETE',
					'action' => ['Admin\AdminVideoController@delete', $video->id],
					'class'  => 'delete-form'
				]) !!}
					{!! Form::submit('Delete', ['class' => 'hidden destroyit']) !!}
				{!! Form::close() !!}
				<small class="lesson-block-length">
				</small>
			</div>
			<div class="lesson-block-excerpt">
			    <p>{{ $video->description }}</p>
			</div>
		</div>
	@endforeach
	</div>
</div>
@endsection

@section('scripts')
<script>
	$('.delete-the-video').click(function(e) {
		e.preventDefault();

		var videoId = $(this).attr('id');

		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this video!",
			type: "error",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false
		}, function(){
			$('#'+videoId+'-container').find('.destroyit').trigger('click');
		});
	});
</script>
@endsection