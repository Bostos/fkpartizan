@extends('layouts.master')
@section('title', 'Takmičenje')
@section('content')

	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" style="min-height: 650px;">
			<div class="container" style="font-size: 14px; font-weight: normal;">

                <div class="row mt-5">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <form action="{{route('single-competition', 1)}}" method="post">
                            {{ csrf_field() }}
                            <div class="row form-group">
                            <div class="col-md-6">
                                <select name="sezona" id="sezona" class="form-control">
                                    <option value="">Izaberite sezonu</option>
                                    @foreach($seasons as $s)
                                        <option value="{{$s->id}}" @if($s->year==$current_season->year) {{'selected'}} @endif> {{$s->year}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">Izaberi</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-5">

                    <div class="col-md-9">

                        

                        @isset($playoff)
                            <h3 align="center">Super liga Srbije - Play Off</h3>
                            <table class="table table-bordered table_style">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Klub</th>
                                        <th>Od.</th>
                                        <th>Pob.</th>
                                        <th>Ner.</th>
                                        <th>Por.</th>
                                        <th>D.P.</th>
                                        <th>Bod.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($playoff as $c)
                                    <tr>
                                        <td @if($loop->iteration==1) class="pos-po-back-blue" @elseif($loop->iteration>1 && $loop->iteration<=4) class="pos-po-back-green" @endif>{{$loop->iteration}}</td>
                                        <td>{{$c->club}}</td>
                                        <td>{{$c->matches}}</td>
                                        <td>{{$c->wins}}</td>
                                        <td>{{$c->draws}}</td>
                                        <td>{{$c->defeats}}</td>
                                        <td>{{$c->goals_for}}:{{$c->goals_against}}</td>
                                        <td>{{$c->points}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endisset
                        </br>

                        @isset($clubs)
                            <h3 align="center">Super liga Srbije - Preliminarna faza</h3>
                            <table class="table table-bordered table_style">
                                <thead>
                                    <tr align="center">
                                        <th>#</th>
                                        <th>Klub</th>
                                        <th>Od.</th>
                                        <th>Pob.</th>
                                        <th>Ner.</th>
                                        <th>Por.</th>
                                        <th>D.P.</th>
                                        <th>Bod.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clubs as $c)
                                    <tr align="center">
                                        <td @if($loop->iteration<9) class="pos-r-back-green" @endif>{{$loop->iteration}}</td>
                                        <td>{{$c->club}}</td>
                                        <td>{{$c->matches}}</td>
                                        <td>{{$c->wins}}</td>
                                        <td>{{$c->draws}}</td>
                                        <td>{{$c->defeats}}</td>
                                        <td>{{$c->goals_for}}:{{$c->goals_against}}</td>
                                        <td>{{$c->points}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endisset
                        </br>

                        @isset($cup_matches)
                            @foreach($cup_matches as $cm)
                                <h5 align="center">{{$cm->round}} ({{date('d. m. Y.', strtotime($cm->date))}})</h5>
                                <p align="center" style="font-size: 16px;"><a href="{{route('one-match', $cm->id)}}" style="text-decoration: none; color: black;">{{$cm->home_team}} - {{$cm->away_team}} {{$cm->home_goals}}:{{$cm->away_goals}}</a></p><br/>
                            @endforeach
                        @endisset

                        @isset($europa_league)

                            @isset($el_matches)
                                @foreach($el_matches as $le)
                                    <h5 align="center">{{$le->round}} ({{date('d. m. Y.', strtotime($le->date))}})</h5>
                                    <p align="center" style="font-size: 16px;"><a href="{{route('one-match', $le->id)}}" style="text-decoration: none; color: black;">{{$le->home_team}} - {{$le->away_team}} {{$le->home_goals}}:{{$le->away_goals}}</a></p><br/>
                                @endforeach
                            @endisset

                            <h3 align="center">Liga Evrope - Grupa B</h3> </br>
                            <table class="table table-bordered table_style">
                                <thead>
                                    <tr align="center">
                                        <th>#</th>
                                        <th>Klub</th>
                                        <th>Od.</th>
                                        <th>Pob.</th>
                                        <th>Ner.</th>
                                        <th>Por.</th>
                                        <th>D.P.</th>
                                        <th>Bod.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($europa_league as $c)
                                    <tr align="center">
                                        <td @if($loop->iteration<3) class="pos-r-back-green" @endif>{{$loop->iteration}}</td>
                                        <td>{{$c->club}}</td>
                                        <td>{{$c->matches}}</td>
                                        <td>{{$c->wins}}</td>
                                        <td>{{$c->draws}}</td>
                                        <td>{{$c->defeats}}</td>
                                        <td>{{$c->goals_for}}:{{$c->goals_against}}</td>
                                        <td>{{$c->points}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endisset
                        </br>

                        @isset($cl_matches)
                            @foreach($cl_matches as $cl)
                                <h5 align="center">{{$cl->round}} ({{date('d. m. Y.', strtotime($cl->date))}})</h5>
                                <p align="center" style="font-size: 16px;"><a href="{{route('one-match', $cl->id)}}" style="text-decoration: none; color: black;">{{$cl->home_team}} - {{$cl->away_team}} {{$cl->home_goals}}:{{$cl->away_goals}}</a></p><br/>
                            @endforeach
                        @endisset

                    </div>

                    <div class="col-md-3">
                        <h3 align="center">Lista strelaca</h3>
                        <table class="table table-bordered table_style">
                            <thead>
                                <tr>
                                    <th>Igrač</th>
                                    <th>Golovi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($goalscorers as $g)
                                <tr>
                                    <td>{{$g->name}}</td>
                                    <td align="center">{{$g->goals}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

			</div>
		</div>
	</div>

@endsection