@extends('admin.pages.content')
@section('page_heading','Pregled svih golova')
@section('breadcrumbs')
  <li class="active">Goals</li>
@endsection
@section('content')
    
    <div class="animated fadeIn">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                @if(session('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger"> {{session('error')}} </div>
                @endif
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong class="card-title">Filteri</strong></div>
                        <div class="card-header">
                        <form class="form-horizontal" method="get" action="{{ route('goals.filter') }}">
                            <div class="row form-group">
                              <label for="igrac" class="col-sm-1 col-form-label-sm"><b>Igrač:</b></label>
                              <div class="col-2 col-md-2">
                                  <select name="igrac" id="igrac" class="form-control form-control-sm">
                                    <option value="">Svi igrači</option>
                                    @foreach($players as $p)
                                    <option value="{{$p->id}}" {{ (old("igrac") == $p->id ? "selected":"") }}> {{$p->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <label for="takmicenje" class="col-sm-1 col-form-label-sm"><b>Takmičenje:</b></label>
                              <div class="col-2 col-md-2">
                                  <select name="takmicenje" id="takmicenje" class="form-control form-control-sm">
                                    <option value="">Sva takmičenja</option>
                                    @foreach($competitions as $c)
                                    <option value="{{$c->id}}" {{ (old("takmicenje") == $c->id ? "selected":"") }}> {{$c->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <label for="sezona" class="col-sm-1 col-form-label-sm"><b>Sezona:</b></label>
                              <div class="col-1 col-md-1">
                                  <select name="sezona" id="sezona" class="form-control form-control-sm">
                                    <option value="">Sve sezone</option>
                                    @foreach($seasons as $s)
                                    <option value="{{$s->id}}" {{ (old("sezona") == $s->id ? "selected":"") }}> {{$s->year}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <label for="tip" class="col-sm-1 col-form-label-sm"><b>Tip:</b></label>
                              <div class="col-1 col-md-1">
                                  <select name="tip" id="tip" class="form-control form-control-sm">
                                    <option value="">Svi tipovi</option>
                                    @foreach($type as $t)
                                    <option value="{{$t->type}}" {{ (old("tip") == $t->type ? "selected":"") }}> {{$t->type}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-primary btn-sm mb-2">Primeni</button> 
                           </div>
                        </form>
                    </div>
                    
                    <div class="card-body">

                        @isset($info)
                            <div class="alert alert-warning">{{$info}}</div>
                        @endisset

                        @if(count($goals)!=0)
		                  <table class="table table-striped table-bordered">

		                    <thead>
		                      <tr>
		                        <th>Igrač</th>
		                        <th>Minut</th>
		                    	<th>Tip</th>
                                <th>Utakmica</th>
		                        <th>Takmičenje / Sezona</th>
		                        <th>Upravljanje</th>
		                      </tr>
		                    </thead>
		                    <tbody>
		                    	@foreach($goals as $g)
		                    	<tr>
			                        <td>{{$g->player}}</td>
			                        <td>{{$g->minute}}</td>
			                        <td>{{$g->type}}</td>
			                        <td>{{$g->home_team}} - {{$g->away_team}} {{$g->home_goals}}:{{$g->away_goals}} ({{date('d.m.Y', strtotime($g->date))}})</td>
			                        <td>{{$g->competition}} ({{$g->season}})</td>
			                        <td><a href="{{route('goals.edit', $g->goal_id)}}">EDIT</a> / <a href="{{route('goals.destroy', $g->goal_id)}}" data-toggle="modal" data-target="#modalGoal-{{$g->goal_id}}" >DELETE</a></td>
		                      	</tr>
		                    	@endforeach
		                    </tbody>
		                </table>
                      @endif
                    </div>

                    <div class="card-footer">
                        <div style="margin-left: 35%;">
                            @if(old('igrac')!=null)
                                @foreach($players as $p)
                                    @if(old('igrac') == $p->id) <input class="btn btn-info btn-sm" type="button" value="{{$p->name}} "> @endif
                                @endforeach
                            @endif
                            @if(old('takmicenje')!=null)
                                @foreach($competitions as $c)
                                    @if(old('takmicenje') == $c->id) <input class="btn btn-info btn-sm" type="button" value="{{$c->name}} "> @endif
                                @endforeach
                            @endif
                            @if(old('sezona')!=null)
                                @foreach($seasons as $s)
                                    @if(old('sezona') == $s->id) <input class="btn btn-info btn-sm" type="button" value="{{$s->year}} "> @endif
                                @endforeach
                            @endif
                            @if(old('tip')!=null)
                                @foreach($type as $t)
                                    @if(old('tip') == $t->type) <input class="btn btn-info btn-sm" type="button" value="{{$t->type}} "> @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div><!-- .animated -->

    <!-- Modal dialog Goal -->
    @foreach($goals as $g)
    <div class="modal fade" id="modalGoal-{{$g->goal_id}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Brisanje utakmice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Da li ste sigurni da želite da obrišete gol {{$g->player}} ({{$g->minute}} min) na utakmici {{$g->home_team}} - {{$g->away_team}}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                    <form action="{{route('goals.destroy', $g->goal_id)}}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Potvrdi</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection