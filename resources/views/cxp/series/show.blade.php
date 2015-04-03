@extends('app-with-video')

@section('content')

<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
	<div class="row card-jaundis">
		<div class="col-md-12 series-show">
			<div class="card">
				<div class="card-header">
					<div class="card-image col-sm-12" style="background-image: url({{ $series->thumbnail_url }}.jpg);">
				        {{-- <img class="img-responsive" src="{{ $series->thumbnail_url }}.jpg"> --}}
					    <span class="card-title col-sm-12">
				        	<h1>{{ $series->name }}</h1>
					    </span>
				    </div>
				</div>

			    <div class="card-content">
			        <p>{{ $series->description }}</p>
			    </div>

			    <div class="card-action">
					<div class="wrap">
			        @foreach ($series->videos()->orderBy('series_video.order', 'asc')->get() as $video)
			        	<a href="/series/{{ $series->slug }}/{{ $video->id }}">
					    	<div class="row video-link">
					        	<div class="left">
					        		<img src="{{ $video->thumbnail_url }}.jpg" class="img-responsive">
					        	</div>
					        	<div class="right">
						        	<h4>{{ $video->name }}</h4> <span class="time"><i class="fa fa-clock-o"></i> {{ $video->duration() }}</span>
						        	<p>{{ $video->description }}</p>
					        	</div>
					    	</div>
			        	</a>
					@endforeach
					</div>
			    </div>
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')
<script>
$('document').ready(function(){
	$('.video-link').hover(
		function() {
			$(this).find('img').toggleClass('remove-da-gray');
			$(this).find('.right').toggleClass('make-dis-shit-diff-color');
			$(this).find('h4').toggleClass('make-dis-shit-diff-color');
			$(this).find('p').toggleClass('make-dis-shit-diff-color');
			$(this).find('span').toggleClass('make-dis-shit-diff-color');
			$(this).find('i').toggleClass('make-dis-shit-diff-color');
		},
		function() {
			$(this).find('img').toggleClass('remove-da-gray');
			$(this).find('.right').toggleClass('make-dis-shit-diff-color');
			$(this).find('h4').toggleClass('make-dis-shit-diff-color');
			$(this).find('p').toggleClass('make-dis-shit-diff-color');
			$(this).find('span').toggleClass('make-dis-shit-diff-color');
			$(this).find('i').toggleClass('make-dis-shit-diff-color');
		});
});
</script>
@endsection