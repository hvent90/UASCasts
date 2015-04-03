@extends('admin')

@section('content')

<div class="container">
	<div class="row featured-videos">
	@foreach($allHardware as $hardware)
		<div class="col-md-4">
			<div class="featured-video" id="{{ $hardware->id }}-container" style="background: url({{ $hardware->thumbnail_url }}-bw.jpg);">
				<h3 class="lesson-block-title  not-watched">
					<a href="#" title="">{{ $hardware->name }}</a>
				</h3>
				<a href="/olympus/hardware/edit/{{ $hardware->id }}" class="media-tile-module">Edit</a>
			    <a href="#" id="{{ $hardware->id }}"class="delete-the-video media-tile-module">Delete</a>
				{!! Form::model($hardware, [
					'method' => 'DELETE',
					'action' => ['Admin\AdminHardwareController@delete', $hardware->id],
					'class'  => 'delete-form'
				]) !!}
					{!! Form::submit('Delete', ['class' => 'hidden destroyit']) !!}
				{!! Form::close() !!}
				<small class="lesson-block-length">
				</small>
			</div>
			<div class="lesson-block-excerpt">
			    <p>{{ $hardware->description }}</p>
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

		var hardwareId = $(this).attr('id');

		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this hardware!",
			type: "error",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false
		}, function(){
			$('#'+hardwareId+'-container').find('.destroyit').trigger('click');
		});
	});
</script>
@endsection