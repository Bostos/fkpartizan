@extends('layouts.master')
@section('title', 'Utakmica')
@section('content')

	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" style="min-height: 650px;">
			<div class="container" style="margin-left: 10%;">

				<div class="row mt-3">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<h5 align="center">{{$match->name}} - {{$match->round}} ({{$match->year}})</h5>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-md-5">
						<div class="row">
							<img style="width: 100px; height: 100px; margin-right: 30px;" src="{{asset($match->home_logo)}}"> <h1 class="mt-4">{{$match->home_team}}</h1>
						</div>
						<div class="row" style="margin-top: 20px; padding-left: 100px; font-weight: normal;">{!!$match->home_scorers!!}</div>
					</div>
					<div class="col-md-2"><h1 class="mt-4">{{$match->home_goals}} - {{$match->away_goals}}</h1></div>
					<div class="col-md-5">
						<div class="row">
							<h1 class="mt-4"> {{$match->away_team}} </h1> <img style="width: 100px; height: 100px; margin-left: 30px;" src="{{asset($match->away_logo)}}">
						</div>
						<div class="row" style="margin-top: 20px; font-weight: normal;"> {!!$match->away_scorers!!} </div>
					</div>
				</div>
				<div class="row mt-3">
					<div class="container" style="margin-top: 50px;"> {!!$match->highlights!!} </div>
				</div>
			</div>
		</div>
	</div>

@endsection