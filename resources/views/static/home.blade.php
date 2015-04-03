@extends('landing')

@section('content')

<div class="hero">
	<div class="container">
		<div class="hvr-grow billy-is-here col-md-4 col-md-offset-8">
			<h2>UNLOCK THE BEST UAS RESOURCE ON THE WEB</h2>
			<a href="/series" class="hvr-grow"><p>HELLO, HAL</p></a>
			<a class="hvr-grow sign-billy-up" href="/plans">Begin Learning Now</a> <br />
			<a class="homie-login hvr-grow " href="/auth/login">or login here</a>
		</div>
	</div>
</div>

{{-- <div class="homepage-piece featured-videos container">
	<div class="container">
		<div class="row">
			<h2>The most concise screencasts for the working developer, updated daily.</h2>
		</div>
	</div>
	<span class="section-heading-divider"></span>

	@for($i = 0; $i < 6; $i++)
	<div class="col-md-4">
		<div class="featured-video" style="background: -webkit-linear-gradient(top, rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url(/img/stock.png);">
			<div class="lesson-block-thumbnail">
	            <i class="fa fa-plane"></i>
	        </div>
	        <h5 class="lesson-block-difficulty">
				intermediate
			</h5>
			<h3 class="lesson-block-title  not-watched">
				<a href="#" title="">Envoyer</a>
			</h3>
			<small class="lesson-block-length">
			    34:00
			</small>
		</div>
		<div class="lesson-block-meta">
		    <div class="lesson-date">
		        Mar. 15th 2015
		    </div>
		</div>
		<div class="lesson-block-excerpt">
		    <p>Envoyer deploys your PHP applications with zero downtime. Just push your code, and let Envoyer deliver your application<a href="https://laracasts.com/series/envoyer">...</a></p>
		</div>
	</div>
	@endfor
</div> --}}

<div>
	<div class="homepage-piece container card-jaundis">
		<div class="card hvr-grow-shadow force-block">
			<div class="awesome-header">
				<h2>Learn from the best educational resource for the professional UAS developer.</h2>
			</div>
		</div>
		<span class="section-heading-divider"></span>
		<div class="row card-jaundis">
			@foreach ($allSeries as $series)
				<div class="col-md-4">
					<div class="card hvr-grow">
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
</div>

{{-- <div id="buy-please">
    <div class="text-center container wrap">
        <h2 class="wow fadeIn alone animated" style="visibility: visible;">
            <a href="https://laracasts.com/join">Buy us lunch</a> once a month, and We'll teach you<br>
            everything about <a href="http://px4.io">PX4</a> and modern UAS workflow.
        </h2>
    </div>
</div>

<div class="homepage-piece container" id="testimonials">
	<div class="container">
		<div class="row">
			<h2><a href="#">These folks think PX4Casts is pretty dang cool.</a></h2>
		</div>
	</div>
	<span class="section-heading-divider"></span>

	<div class="row">
	@for($i = 0; $i < 6; $i++)
		<div class="col-md-4 testimonial">
		    <div class="row">
		        <div class="avatar col-md-5">
		            <a href="#their-website">
		                <img class="img-circle" src="/img/me.jpg" alt="name">
		            </a>
		        </div>

		        <div class="testimonial-main col-md-7">
		            <h4 class="media-heading"><a href="http://laravel.com">Henry Ventura</a></h4>
		            <p class="testimony-body">PX4Casts rocks!</p>
		        </div>
		    </div>
		</div>
	@endfor
	</div>
</div> --}}

<div id="buy-please-again">
    <div class="text-center container wrap">
    	<div class="card">
			<div class="awesome-header hvr-overline-from-center hvr-grow-shadow force-block">
		        <h2>
		            <a href="/series" class="hvr-grow">Start browsing</a> or <a href="/plans" class="hvr-grow">sign up now</a> and begin learning!
		        </h2>
			</div>
		</div>
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