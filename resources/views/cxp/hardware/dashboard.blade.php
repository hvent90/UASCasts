@extends('app-with-video')

@section('content')

<div class="container hardware-cardware-container" style="padding-top: 40px; padding-bottom: 40px;">
	@foreach ($allHardware as $hardware)
		<div class="row hardware-card-jaundis card-jaundis">
			<div class="col-md-12 series-show">
				<div class="card">
					<div class="card-header card-title-new">
			        	<h2>{{ $hardware->name }}</h2>
					</div>

				    <div class="card-content">
				    	<img class="col-xs-2" src="{{ $hardware->thumbnail_url }}.jpg">
				        <p>{!! nl2br($hardware->description) !!}</p>
				    </div>

				    <a href="{{ $hardware->url }}">
					    <div class="card-action hvr-grow-shadow force-block">
					    	<h4>MORE INFO</h4>
					    </div>
					</a>
				</div>
			</div>
		</div>
	@endforeach
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