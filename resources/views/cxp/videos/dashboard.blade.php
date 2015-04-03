@extends('app-with-video')

@section('content')
<div class=" video-dashboard-container card-jaundis">
	<div class="col-sm-3 categories-card">
		<div class="card">
			<div class="card-content">
				<h3>Categories</h3>
			</div>
			@foreach ($categories as $category)
				<a href="/videos/category/{{ $category->name }}">
					<div class="@if($category->name == $currentCategoryName) selected @endif card-action hvr-grow-shadow force-block">
						{{ $category->name }}
					</div>
				</a>

			@endforeach
			<div class="card-action paginator-container">
				{!! $categories->render() !!}
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="card-jaundis">
			@foreach ($videos as $video)
				<div class="col-md-4">
					<div class="card hvr-grow-shadow video-card">
						<a href="/videos/{{ $video->id }}">
							<div class="card-image">
						        <img class="no-transition" src="{{ $video->thumbnail_url }}.jpg">
						        @if ($video->isFree())
						        	<span class="card-title video-card-free"><span>Free</span></span>
						        @endif
						        <span class="card-title video-card-title"><span>{{ $video->name }}</span></span>
						    </div>
					    </a>

					    <div class="card-content force-it series-description">
					        <p>{{ $video->description }}</p>
					    </div>

					    <div class="card-action">
					        <div class="wrap video-meta">
					        	<span class="video-categories">{!! $video->outputCategories() !!}</span>
					        	<span class="right-sheet"><i class="fa fa-clock-o"></i> {{$video->duration()}}</span>
							</div>
					    </div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script>
$('document').ready(function() {

	$(".card-image > img").each(function(){
	    ratio = $(this).width() / $(this).height(),
	    limit = (100*ratio)+"%",
	    margin = ((1-ratio)*50)+"%";

	if( ratio > 1)
	{
	    $(this).css({"width": limit, "margin-left": margin});
	}
	else
	{
	    ratio = 1 / ratio;
	    $(this).css({"height": limit, "margin-top": margin});
	}});

	setTimeout(function(){
		$('.card-image > img').each(function() {
				$(this).removeClass('no-transition');
		});
	}, 250);

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