@extends('admin.pages.content')
@section('page_heading','Pregled svih utakmica')
@section('breadcrumbs')
  <li class="active">Matches</li>
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
                        <form class="form-horizontal" method="get" action="{{ route('matches.filter') }}">
                            <div class="row form-group">
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
                              <div class="col-2 col-md-2">
                                  <select name="sezona" id="sezona" class="form-control form-control-sm">
                                    <option value="">Sve sezone</option>
                                    @foreach($seasons as $s)
                                    <option value="{{$s->id}}" {{ (old("sezona") == $s->id ? "selected":"") }}> {{$s->year}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <label for="klub" class="col-sm-1 col-form-label-sm"><b>Klub:</b></label>
                              <div class="col-2 col-md-2">
                                  <select name="klub" id="klub" class="form-control form-control-sm">
                                    <option value="">Svi klubovi</option>
                                    @foreach($clubs as $c)
                                    <option value="{{$c->name}}" {{ (old("klub") == $c->name ? "selected":"") }}> {{$c->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-primary btn-sm mb-2">Primeni</button>
                           </div>
                        </form>
                    </div>
                </div>   
            </div>   
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <form id="sortForm" method="get" action="{{route('matches.index')}}">
                        <div class="form-group row">
                            <label for="sort" class="col-sm-1 col-form-label"><b>Sortiraj:</b></label>
                            <div class="col-sm-2">
                            <select name="sort" id="sort" class="form-control form-control-sm">
                              <option value="">Izaberi...</option>
                              <option value="date" {{ (old("sort") == "date" ? "selected":"") }} >Datum odigravanja</option>
                            </select>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="card-body">
                      @isset($info)
                        <div class="alert alert-warning">{{$info}}</div>
                      @endisset

                      @if(count($matches)!=0)
		                  <table class="table table-striped table-bordered">

		                    <thead>
		                      <tr>
		                        <th>Meč</th>
		                        <th>Datum</th>
		                    	<th>Mesto</th>
		                        <th style="width: 220px;">Takmičenje</th>
		                        <th>Strelci za domaćina</th>
		                        <th>Strelci za gosta</th>
		                        <th>Izmeni</th>
                            <th>Obriši</th>
		                      </tr>
		                    </thead>
		                    <tbody>
		                    	@foreach($matches as $m)
		                    	<tr>
			                        <td style="width: 300px;"><img style="width: 20px; height: 20px;" src="{{asset($m->home_logo)}}"/> {{$m->home_team}} - {{$m->away_team}} <img style="width: 20px; height: 20px;" src="{{asset($m->away_logo)}}"/> {{$m->home_goals}}:{{$m->away_goals}} </td>
			                        <td>{{date('d.m.Y', strtotime($m->date))}}</td>
			                        <td>{{$m->place}}</td>
			                        <td style="font-size: 12px;">{{$m->name}} ({{$m->year}}) - {{$m->round}}</td>
			                        <td style="font-size: 12px;">{!!$m->home_scorers!!}</td>
			                        <td style="font-size: 12px;">{!!$m->away_scorers!!}</td>
			                        <td><a href="{{route('matches.edit', $m->id)}}">EDIT</a></td>
                              <td><a href="{{route('matches.destroy', $m->id)}}" data-toggle="modal" data-target="#modalMatch-{{$m->id}}">DELETE</a></td>
		                      	</tr>
		                    	@endforeach
		                    </tbody>
		                </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->

    <!-- Modal dialog Match -->
    @foreach($matches as $m)
    <div class="modal fade" id="modalMatch-{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Brisanje utakmice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Da li ste sigurni da želite da obrišete utakmicu "{{$m->home_team}} - {{$m->away_team}}" ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                    <form action="{{route('matches.destroy', $m->id)}}" method="post">
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

@section('script')
  <script type="text/javascript">
    jQuery(function ($){

      $('#sort').change(function(){
        $('#sortForm').submit();
      });

    });
  </script>
@endsection