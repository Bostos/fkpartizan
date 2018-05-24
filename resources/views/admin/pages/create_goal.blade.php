@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('goals.index')}}">Goals</a></li>
  <li class="active">Add goal</li>
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
          
          <!-- Blok avatar -->
        	<div class="col col-md-3">
          </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Dodavanje gola</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('goals.store')}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="igrac" class=" form-control-label"><b>Igrač</b></label></div>
                            <div class="col-9 col-md-4">
                              <select name="igrac" id="igrac" class="form-control">
                                <option value="">Izaberite igrača</option>
                                @foreach($players as $p)
                                  <option value="{{$p->id}}" {{(old('igrac')==$p->id)? 'selected' : '' }}> {{$p->name}} @if($p->status!='Prvi tim') {{' (Bivši)'}} @endif </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="uktamica" class=" form-control-label"><b>Utakmica</b></label></div>
                            <div class="col-9 col-md-4">
                              <select name="utakmica" id="utakmica" class="form-control">
                                <option value="">Izaberite utakmicu</option>
                                @foreach($matches as $m)
                                  <option value="{{$m->id}}" {{(old('utakmica')==$m->id)? 'selected' : '' }}> {{$m->home_team.' - '.$m->away_team.' '.$m->home_goals.':'.$m->away_goals.' ('.date('d.m.Y', strtotime($m->date)).')'}} </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="minut" class=" form-control-label"><b>Minut</b></label></div>
                            <div class="col-9 col-md-2"><input type="number" id="minut" name="minut" class="form-control" min="1" max="123" value="{{old('minut')}}"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label"><b>Tip</b></label></div>
                            <div class="col col-md-9">
                              <div class="form-check-inline form-check">
                                <label for="tip1" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="tip1" name="tip" value="Iz igre" class="form-check-input" {{(old('tip')=='Iz igre')? 'checked' : '' }}>Iz igre 
                                </label>
                                <label for="tip2" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="tip2" name="tip" value="Posle prekida" class="form-check-input" {{(old('tip')=='Posle prekida')? 'checked' : '' }}>Posle prekida 
                                </label>
                                <label for="tip3" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="tip3" name="tip" value="Slobodan udarac" class="form-check-input" {{(old('tip')=='Slobodan udarac')? 'checked' : '' }}>Slobodan udarac
                                </label>
                                </label>
                                <label for="tip4" class="form-check-label">
                                  <input type="radio" id="tip4" name="tip" value="Kazneni udarac" class="form-check-input" {{(old('tip')=='Kazneni udarac')? 'checked' : '' }}>Kazneni udarac 
                                </label>
                              </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Dodaj gol</button>
                        </form>
                      </div>

                      @if($errors->any())
        						    <div class="alert alert-danger">
        						      <ul>
        						        @foreach ($errors->all() as $error)
        						          <li>{{ $error }}</li>
        						        @endforeach
        						      </ul>
        						    </div>
						          @endif
            </div>

            <div class="col-md-3"></div>

          </div>
    </div><!-- .animated -->

@endsection