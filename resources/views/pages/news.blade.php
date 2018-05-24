@extends('layouts.master')
@section('title', 'Vesti')
@section('content')
	
	<div class="row" style="padding: 0 20px 10px 20px;">
		<div class="col-md-3"></div>
		<div class="col-md-4" style="height: 360px;">
			@foreach($news as $n)
				@if($loop->iteration==1)
					<a href="{{route('news.display', $n->id)}}" style="text-decoration: none; color: inherit">
						<div style="position: relative; height: 360px; overflow: hidden;">
							<img style="width: 100%; height: auto;" src="{{asset($n->cover_image)}}">
							<div style="position: absolute;
								height: 80px;
								width: 605px;
								bottom: 0px;
							    background-color: black;
							    color: white;
							    padding-left: 20px;
							    padding-right: 20px;
							    opacity: 0.7"
							>
								<h4 class="pt-4"><b>{{$n->title}}</b></h4>
							</div>	
						</div>
					</a>
				@else @break
				@endif
			@endforeach
		</div>
		<div class="col-md-2" style="padding: 0;">
			@foreach($news as $n)
				@if(($loop->iteration>1) && ($loop->iteration<=3))
					<div class="row" style="height: 180px;">
						<a href="{{route('news.display', $n->id)}}" style="text-decoration: none; color: inherit">
							<div style="position: relative; height: 180px; overflow: hidden;">
								<img style="width: 100%; height: auto;" src="{{asset($n->cover_image)}}">
								<div style="position: absolute;
										height: 60px;
										width: 346px;
										bottom: 0px;
									    background-color: black;
									    color: white;
									    padding-left: 10px;
									    padding-right: 10px;
									    opacity: 0.7"
								>
								<h4 class="pt-2" style="font-size: 16px;"><b>{{$n->title}}</b></h4>
								</div>	
							</div>
						</a>
					</div>
				@endif
			@endforeach
		</div>
	</div> 

	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 ml-3">
			<div class="row mt-3 mb-3">
				@foreach($news as $n)
					@if($loop->iteration>3)
						<div class="col-md-4" style="padding: 10px;">
							<a href="{{route('news.display', $n->id)}}" style="text-decoration: none; color: inherit">
								<div style="position: relative; height: 220px; overflow: hidden; background-color: black;">
									<img style="width: 100%; height: 100%;" src="{{asset($n->cover_image)}}">
									<div style="position: absolute;
											height: 60px;
											width: 100%;
											bottom: 0px;
										    background-color: black;
										    color: white;
										    padding-left: 10px;
										    padding-right: 10px;
										    opacity: 0.7"
									>
									<h4 class="pt-2" style="font-size: 16px;"><b>{{$n->title}}</b></h4>
									</div>	
								</div>
							</a>
						</div>
					@endif
				@endforeach
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>

@endsection
