@extends('layouts.master')
@section('title', 'Utakmice')
@section('content')
	
	<div class="row" style="padding: 0 5px 0 5px;">
		<div class="col-md-3"></div>
		<div class="col-md-6 pt-2">

			<div class="default-tab" >

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-sl-tab" data-toggle="tab" href="#nav-sl" role="tab" aria-controls="nav-sl" aria-selected="true">Super Liga</a>
                        <a class="nav-item nav-link" id="nav-ks-tab" data-toggle="tab" href="#nav-ks" role="tab" aria-controls="nav-ks" aria-selected="false">Kup Srbije</a>
                        <a class="nav-item nav-link" id="nav-ls-tab" data-toggle="tab" href="#nav-ls" role="tab" aria-controls="nav-ls" aria-selected="false">Liga Šampiona</a>
                        <a class="nav-item nav-link" id="nav-le-tab" data-toggle="tab" href="#nav-le" role="tab" aria-controls="nav-le-tab" aria-selected="false">Liga Evrope</a>
                        <a class="nav-item nav-link" id="nav-pr-tab" data-toggle="tab" href="#nav-pr" role="tab" aria-controls="nav-pr" aria-selected="false">Prijateljske</a>
                    </div>
                </nav>

                <!-- <form style="float: right;">
                	<label>Sezona: </label>
                	<select class="form-control">
                		<option>Izaberi</option>
                	</select>
                </form> -->

				<div class="tab-content pl-3 pt-2" id="nav-tabContent">

	                <div class="tab-pane fade show active" id="nav-sl" role="tabpanel" aria-labelledby="nav-sl-tab">
	                    @foreach($superliga as $sl)
	                        <div class="container" id="match-row" align="center">
	                        	<div class="row" style="height: 35px; border-bottom: 1px solid #e6e6e6;">
	                        		<div class="col-md-1 mt-1">{{date('d/m/Y', strtotime($sl->date))}}</div>
		                        	<div class="col-md-3 mt-1" align="right">{{$sl->home_team}}</div>
		                        	<div class="col-md-1 mt-1" align="right"><img style="width: 30px; height: 30px;" src='{{asset($sl->home_logo)}}'></div>
		                        	<div class="col-md-1 mt-1" id="result">{{$sl->home_goals}} : {{$sl->away_goals}}</div>
		                        	<div class="col-md-1 mt-1" align="left"><img style="width: 30px; height: 30px;" src='{{asset($sl->away_logo)}}'></div>
		                        	<div class="col-md-3 mt-1" align="left"> {{$sl->away_team}}</div>
		                        	<div class="col-md-2 mt-1"><a href="{{route('one-match', $sl->id)}}">Opširnije</a></div>
	                        	</div>
	                        </div>
	                    @endforeach
	            	</div>
	            	<!-- /jedan panel-->

	                <div class="tab-pane fade" id="nav-ks" role="tabpanel" aria-labelledby="nav-ks-tab">
	                    @foreach($kup as $ks)
	                    {{date("F", mktime(0, 0, 0, $ks->month, 1))}}
		                        <div class="container" id="match-row" align="center">
		                        	<div class="row" style="height: 35px; border-bottom: 1px solid #e6e6e6;">
		                        		<div class="col-md-1 mt-1">{{date('d/m/Y', strtotime($ks->date))}}</div>
			                        	<div class="col-md-3 mt-1" align="right">{{$ks->home_team}}</div>
			                        	<div class="col-md-1 mt-1" align="right"><img style="width: 30px; height: 30px;" src='{{asset($ks->home_logo)}}'></div>
			                        	<div class="col-md-1 mt-1" id="result">{{$ks->home_goals}} : {{$ks->away_goals}}</div>
			                        	<div class="col-md-1 mt-1" align="left"><img style="width: 30px; height: 30px;" src='{{asset($ks->away_logo)}}'></div>
			                        	<div class="col-md-3 mt-1" align="left"> {{$ks->away_team}}</div>
			                        	<div class="col-md-2 mt-1"><a href="{{route('one-match', $ks->id)}}">Opširnije</a></div>
		                        	</div>
		                        </div>
	                    @endforeach
	            	</div>
	            	<!-- /jedan panel-->

	            	<div class="tab-pane fade" id="nav-ls" role="tabpanel" aria-labelledby="nav-ls-tab">
	                    @foreach($ligasampiona as $ls)
	                        <div class="col-md-12" id="match-row" align="center">
	                            <div class="container" id="match-row" align="center">
		                        	<div class="row" style="height: 100%;">
		                        		<div class="col-md-1">{{date('d/m/Y', strtotime($ls->date))}}</div>
			                        	<div class="col-md-3" align="right">{{$ls->home_team}}</div>
			                        	<div class="col-md-1" align="right"><img style="width: 30px; height: 30px;" src='{{asset($ls->home_logo)}}'></div>
			                        	<div class="col-md-1" id="result">{{$ls->home_goals}} : {{$ls->away_goals}}</div>
			                        	<div class="col-md-1" align="left"><img style="width: 30px; height: 30px;" src='{{asset($ls->away_logo)}}'></div>
			                        	<div class="col-md-3" align="left"> {{$ls->away_team}}</div>
			                        	<div class="col-md-2"><a href="{{route('one-match', $ls->id)}}">Opširnije</a></div>
		                        	</div>
		                        	<hr>
		                        </div>
	                        </div>
	                    @endforeach
	            	</div>
	            	<!-- /jedan panel-->

	            	<div class="tab-pane fade" id="nav-le" role="tabpanel" aria-labelledby="nav-le-tab">
	                    @foreach($ligaevrope as $le)
	                        <div class="col-md-12" id="match-row" align="center">
	                            <div class="container" id="match-row" align="center">
		                        	<div class="row" style="height: 35px; border-bottom: 1px solid #e6e6e6;">
		                        		<div class="col-md-1 mt-1">{{date('d/m/Y', strtotime($le->date))}}</div>
			                        	<div class="col-md-3 mt-1" align="right">{{$le->home_team}}</div>
			                        	<div class="col-md-1 mt-1" align="right"><img style="width: 30px; height: 30px;" src='{{asset($le->home_logo)}}'></div>
			                        	<div class="col-md-1 mt-1" id="result">{{$le->home_goals}} : {{$le->away_goals}}</div>
			                        	<div class="col-md-1 mt-1" align="left"><img style="width: 30px; height: 30px;" src='{{asset($le->away_logo)}}'></div>
			                        	<div class="col-md-3 mt-1" align="left"> {{$le->away_team}}</div>
			                        	<div class="col-md-2 mt-1"><a href="{{route('one-match', $le->id)}}">Opširnije</a></div>
		                        	</div>
		                        </div>
	                        </div>
	                    @endforeach
	            	</div>
	            	<!-- /jedan panel-->

	            	<div class="tab-pane fade" id="nav-pr" role="tabpanel" aria-labelledby="nav-pr-tab">

	            		@foreach($pr_meseci as $m)
	            			{{date("F", mktime(0, 0, 0, $m->month, 1))}}

	            			@foreach($prijateljske as $pr_meseci => $pr)
	            				@if($m->month == date('m', strtotime($pr->date)))
	            				<div class="container" id="match-row" align="center">
		                        	<div class="row" style="height: 35px; border-bottom: 1px solid #e6e6e6;">
		                        		<div class="col-md-1 mt-1">{{date('d/m/Y', strtotime($pr->date))}}</div>
			                        	<div class="col-md-3 mt-1" align="right">{{$pr->home_team}}</div>
			                        	<div class="col-md-1 mt-1" align="right"><img style="width: 30px; height: 30px;" src='{{asset($pr->home_logo)}}'></div>
			                        	<div class="col-md-1 mt-1" id="result">{{$pr->home_goals}} : {{$pr->away_goals}}</div>
			                        	<div class="col-md-1 mt-1" align="left"><img style="width: 30px; height: 30px;" src='{{asset($pr->away_logo)}}'></div>
			                        	<div class="col-md-3 mt-1" align="left"> {{$pr->away_team}}</div>
			                        	<div class="col-md-2 mt-1"><a href="{{route('one-match', $pr->id)}}">Opširnije</a></div>
		                        	</div>
		                        </div>

		                        @endif
	            			@endforeach
	            			
	            		@endforeach

	            	</div>
	            	<!-- /jedan panel-->

	           </div>

	       	</div>
	</div>

@endsection
