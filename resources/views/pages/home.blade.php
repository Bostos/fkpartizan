@extends('layouts.master')
@section('title', 'Početna')
@section('content')

	<!-- Blok za baner i rezultate -->
	<div class="row">
		<div class="col-6 news-main">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 550px; margin-left: -15px; margin-right: -30px;">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					@foreach($slider_news as $sn)
						<div class="carousel-item @if($loop->first) {{'active'}} @endif " style="height: 550px;">
							<a href="{{route('news.display', $sn->id)}}">
							   	<img src="{{$sn->cover_image}}" alt="First Image">
							    <div class="carousel-caption d-none d-md-block">
							        <h2>{{$sn->title}}</h2>
							    </div>
							</a>
						</div>
					@endforeach
				</div>

				<!-- Controls -->
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>

		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12 match-info">
					<div class="row justify-content-center mt-4">{{$last_match->name}} - {{date('d/m', strtotime($last_match->date))}}</div>
					<div class="row mt-3 match-line">
						<div class="col-md-4 pt-3" style="text-align: right;">{{strtoupper($last_match->home_team)}}</div>
						<div class="col-md-1"><img src="{{asset($last_match->home_logo)}}" alt="{{$last_match->home_team}}"></div>
						<div class="col-md-2 pt-2 result">{{$last_match->home_goals}} : {{$last_match->away_goals}}</div>
						<div class="col-md-1"><img src="{{asset($last_match->away_logo)}}" alt="{{$last_match->away_team}}"></div>
						<div class="col-md-4 pt-3 pl-5">{{strtoupper($last_match->away_team)}}</div>
					</div>
					<div class="row justify-content-center mt-4">
						<a type="button" href="{{route('one-match', $last_match->id)}}">IZVEŠTAJ</a>
					</div>
				</div>

				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 news-main-small">
							<a href="">
								<img src="http://www.zurnal.rs/public/gallery/album0067/partizan-radnik-1.jpg">
								<div class="carousel-caption d-none d-md-block"><h3><b>Naslov 1</b></h3></div>
							</a>
						</div>
						<div class="col-md-6 news-main-small">
							<a href="{{route('vesnik')}}">
								<img src="https://i.ytimg.com/vi/lOXmf28r1vk/maxresdefault.jpg">
								<div class="carousel-caption d-none d-md-block"><h3><b>Partizanov Vesnik</b></h3></div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blok za vesti -->
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 block-content">
			<h4>Poslednje vesti</h4><hr>
			<div class="row pt-3">
				@for($i=0; $i < 3; $i++)
					<div class="col-md-4 one-news">
					<a href="{{route('news.display', $slider_news[$i]->id)}}">
						<div class="item"> <img src="{{asset($slider_news[$i]->cover_image)}}"> </div>
						<p class="text-muted">{{date('d.m.Y', strtotime($slider_news[$i]->date))}}</p>
						<h5>{{$slider_news[$i]->title}}</h5>
					</a>
				</div>
				@endfor
			</div>
			<div class="row pt-4">
				<div class="col-md-12"><a href="{{route('news')}}" style="position: absolute; left: 47%;"><h5>OSTALE VESTI</h5></a></div>
			</div>
		</div>
	</div>

	<!-- Blok za sledeću utakmicu -->
	<div class="row" style="background-color:black; color:white;">
		<div class="col-md-3"></div>
		<div class="col-md-6 block-content">
			<h4 style="border-bottom: 1px solid white;"><p style="margin-bottom: 15px;">Naredna utakmica</p></h4><hr>
			<div class="row">
				<div class="col-md-12 next-match">
					@if($next_match)
					<div class="row justify-content-center mt-5" style="font-size: 18px;">{{$next_match->name}} ({{$next_match->round}}) - {{date('d/m', strtotime($next_match->date))}}</div>
					<p style="text-align: center; font-size: 18px; margin-top: 5px;">{{$next_match->place}}</p>
					<div class="row mt-3">
						<div class="col-md-2 pl-5"><img src="{{asset($next_match->home_logo)}}" alt="{{$next_match->home_team}}"></div>
						<div class="col-md-4 pt-5" style="text-align: right;">{{strtoupper($next_match->home_team)}}</div>
						<div class="col-md-4 pt-5 pl-5">{{strtoupper($next_match->away_team)}}</div>
						<div class="col-md-2 pr-5"><img src="{{asset($next_match->away_logo)}}" alt="{{$next_match->away_team}}"></div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>

	<!-- Blok za trofeje -->
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 block-content">
			<h4>Trofeji</h4><hr>
			<div class="row pt-2">
				<div class="col-md-4 pl-2"><img src="{{asset('images/liga.png')}}">27 PUTA ŠAMPION</div>
				<div class="col-md-4 pl-2"><img src="{{asset('images/kup.png')}}">15 PUTA POBEDNIK KUPA</div>
				<div class="col-md-4 pl-2"><img src="{{asset('images/mitropa.png')}}">MITROPA KUP</div>
			</div>
		</div>
	</div>
	
@endsection