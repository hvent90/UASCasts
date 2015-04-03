@extends('app-with-video')

@section('content')

<div class="series-show series-video-show">
	<div class="card-header series-video-title">
		<div class="card-image col-sm-3" style="background-image: url({{ $video->thumbnail_url }}.jpg);">
	    </div>
	    <div class="col-sm-9">
        	<h1>{{ $video->name }}</h1>
	    </div>
	</div>

	<div class="video-jaundis-container">
		<div class="col-sm-9 video-jaundis">
			@if ( $video->isFree() )
				<div class="wrapper">
		 			<div class="videocontent">
						 <video height="auto" width="auto"  id="da-vid" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="none"
							poster="{{ $video->thumbnail_url }}.jpg"
							data-setup='{ "playbackRates": [0.5, 1, 1.5, 2] }'>
							<source src="{{ $video->vimeo_video_url_hd }}" type='video/mp4' data-res="HD" data-default="true"/>
							<source src="{{ $video->vimeo_video_url_sd }}" type='video/mp4' data-res="SD" />
							<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
						</video>
					</div>
				</div>
			@elseif ( Auth::check() )
				@if (Auth::user()->isSubscribed())
					<div class="wrapper">
			 			<div class="videocontent">
							 <video height="auto" width="auto"  id="da-vid" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="none"
								poster="{{ $video->thumbnail_url }}.jpg"
								data-setup='{ "playbackRates": [0.5, 1, 1.5, 2] }'>
								<source src="{{ $video->vimeo_video_url_hd }}" type='video/mp4' data-res="HD" data-default="true"/>
								<source src="{{ $video->vimeo_video_url_sd }}" type='video/mp4' data-res="SD" />
								<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
							</video>
						</div>
					</div>
				@else
					<div class="card-jaundis sign-up-babe">
						<div class="card hvr-grow-shadow force-block">
							<div class="awesome-header hvr-overline-from-center force-block">
								<h2>You must <a class="hvr-grow" href="/settings">Subscribe</a> in order to view this video!</h2>
							</div>
						</div>
					</div>
				@endif
			@else
				<div class="card-jaundis sign-up-babe">
					<div class="card hvr-grow-shadow force-block">
						<div class="awesome-header hvr-overline-from-center force-block">
							<h2>You must <a class="hvr-grow" href="/plans">Register</a> in order to view this video!</h2>
						</div>
					</div>
				</div>
			@endif

			<div class="card-jaundis">
				<div class="card">
					<div class="card-content all-natural-baby hard-edges">
						<p>{{ $video->description }}</p>
					</div>
				</div>
			</div>
			<div class="card-jaundis video-information">
				<div class="card">
					<div class="card-content hard-edges">
						<p>Required Equipment</p>
					</div>
					@foreach ($video->hardware as $hardware)
						<a href="/hardware/{{ $hardware->id }}">
							<div class="card-action equipment-listing">
								{{ $hardware->name }}
							</div>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

</div>
<div class="disqus-container">
<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'uascasts';
    var disqus_identifier = '{{ $video->slug() }}';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

</div>

@endsection


@section('scripts')
<script>
$('document').ready(function(){

	vjs('da-vid', {
		plugins: {
			resolutions: true
		}
	});

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