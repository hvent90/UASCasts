@extends('app-with-video')

@section('content')
{{-- <div class="row" style="margin: 40px auto">
	<div class="col-sm-9 col-sm-offset-1">
		<div class="wrapper">
 			<div class="videocontent">
				 <video height="auto" width="auto"  id="main-videos" class="video-js vjs-default-skin" 	controls preload="none"
					poster="http://video-js.zencoder.com/oceans-clip.png"
					data-setup='{ "playbackRates": [0.5, 1, 1.5, 2] }'>
					<source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />
					<source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
					<source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
					<track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
					<track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
					<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
				</video>
			</div>
		</div>
	</div>
</div> --}}

<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
	<div class="row card-jaundis">
		@foreach ($allSeries as $series)
			<div class="col-md-4">
				<div class="card hvr-grow-shadow">
					<a href="/series/{{ $series->slug }}">
						<div class="card-image">
					        <img class="img-responsive" src="{{ $series->thumbnail_url }}.jpg">
					        @if ($series->allVideosAreFree())
					        	<span class="card-title video-card-free"><span>Free</span></span>
					        @endif
					        <span class="card-title"><i class="fa fa-{{ $series->font_awesome }}"></i><span>{{ $series->name }}</span></span>
					    </div>
				    </a>

				    <div class="card-content force-it series-description">
				        <p>{{ $series->description }}</p>
				    </div>

				    <div class="card-action">
				        <div class="wrap video-meta">
				        	<span class="largen-it">{{ $series->videos()->count() }}</span>
				        	@if ($series->videos()->count() == 1) video
				        	@else videos @endif
				        	<span class="right-sheet"><i class="fa fa-clock-o"></i> {{$series->totalTime()}}</span>
						</div>
				    </div>
				</div>
			</div>
		@endforeach
	</div>
</div>

@endsection

@section('scripts')
<script>
$('document').ready(function() {
	$('.series-description p').trunk8({
		lines: 3
	});

	$('.card').hover(
		function() {
			$(this).find('img').toggleClass('remove-da-gray');
		},
		function() {
			$(this).find('img').toggleClass('remove-da-gray');
		}
	);
});

</script>
@endsection