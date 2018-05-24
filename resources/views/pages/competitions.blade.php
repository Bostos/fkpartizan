@extends('layouts.master')
@section('title', 'Takmičenja')
@section('content')
	
	<div class="row" style="padding: 0 5px 0 5px; min-height: 600px;">
		<div class="col-md-3"></div>
		<div class="col-md-6 pt-2">
			<div class="row">
				@foreach($competitions as $c)
					<div class="col-md-3" style="border-right: 3px solid;" align="center">
						<img style="max-width: 50%; max-height: 50%;" src="{{asset($c->path)}}"><a href="{{route('single-competition', $c->id)}}"><h3 style="padding-top: 20px;">{{$c->name}}</h3></a><h4>({{$season->year}})</h4>
					</div>
				@endforeach
			</div>
		</div>
	</div>

@endsection
