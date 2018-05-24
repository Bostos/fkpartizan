@extends('layouts.master')
@section('title', 'Vesti')
@section('content')

	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 pt-3 pb-5 one-news">
			<h1 class="pl-3" style="font-family: 'Oswald';"><strong>{{$news->title}}</strong></h1>
			<p class="text-muted pl-3" style="float: left;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{date('d.m.Y', strtotime($news->date))}}</p>
			<p class="text-muted" style="margin-left: 70%;">Izvor: {{$news->source}}</p>
			<hr>
			<p>{!! $news->body !!}</p>
		</div>
	</div>

@endsection