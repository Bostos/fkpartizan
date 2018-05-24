@extends('layouts.master')
@section('title', 'Tim')
@section('content')
	
	<div class="row" style="padding: 0 5px 0 5px;">
		<div class="col-md-3"></div>
		<div class="col-md-6 pt-2">
			<h2>Golmani</h2><hr>
			<div class="row mb-4">
				@foreach($goalkeepers as $gk)
				<div class="col-md-4">
					<a href="{{url('/team/'.$gk->id)}}"><img style="width: 100%; height: 90%;" src="{{asset($gk->path)}}"></a>
					<h4 align="center">{{$gk->name}}</h4>
				</div>
				@endforeach
			</div>

			<h2>Odbrana</h2><hr>
			<div class="row mb-4">
				@foreach($defenders as $df)
				<div class="col-md-4">
					<a href="{{url('/team/'.$df->id)}}"><img style="width: 100%; height: 90%;" src="{{asset($df->path)}}"></a>
					<h4 align="center">{{$df->name}}</h4>
				</div>
				@endforeach
			</div>

			<h2>Sredina</h2><hr>
			<div class="row mb-4">
				@foreach($midfielders as $mf)
				<div class="col-md-4">
					<a href="{{url('/team/'.$mf->id)}}"><img style="width: 100%; height: 90%;" src="{{asset($mf->path)}}"></a>
					<h4 align="center">{{$mf->name}}</h4>
				</div>
				@endforeach
			</div>

			<h2>Napad</h2><hr>
			<div class="row mb-4">
				@foreach($attackers as $at)
				<div class="col-md-4">
					<a href="{{url('/team/'.$at->id)}}"><img style="width: 100%; height: 90%;" src="{{asset($at->path)}}"></a>
					<h4 align="center">{{$at->name}}</h4>
				</div>
				@endforeach
			</div>
		</div>
	</div>

@endsection
