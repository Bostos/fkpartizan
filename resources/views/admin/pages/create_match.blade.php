@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('matches.index')}}">Matches</a></li>
  <li class="active">Add match</li>
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
                        <strong><h5>Dodavanje utakmice</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('matches.store')}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="domacin" class=" form-control-label"><b>Domaćin</b></label></div>
                            <div class="col-9 col-md-4"><input type="text" id="domacin" name="domacin" placeholder="Domaćin" class="form-control" value="{{old('domacin')}}"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="gost" class=" form-control-label"><b>Gost</b></label></div>
                            <div class="col-9 col-md-4"><input type="text" id="gost" name="gost" placeholder="Gost" class="form-control" value="{{old('gost')}}"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for=datum" class=" form-control-label"><b>Datum odigravanja</b></label></div>
                            <div class="col-9 col-md-4"><input type="date" id="datum" name="datum" class="form-control" value="{{old('datum')}}"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="mesto" class=" form-control-label"><b>Mesto</b></label></div>
                            <div class="col-9 col-md-4"><input type="text" id="mesto" name="mesto" placeholder="Mesto" class="form-control" value="{{old('mesto')}}"></div>
                          </div>
                          <div class="row form-group-inline">
                            <div class="col col-md-3"><label for="golovi_d" class=" form-control-label"><b>Rezultat</b></label></div>
                            <div class="col-3 col-md-2"><input type="number" id="golovi_d" name="golovi_d" class="form-control" value="{{old('golovi_d')}}"></div>
                            <div class="col-3 col-md-2"><input type="number" id="golovi_g" name="golovi_g" class="form-control" value="{{old('golovi_g')}}"></div>
                            <div class="col-3 col-md-6" style="margin-left: 190px;"><small class="form-text text-muted">* Polja nisu obavezna</small></div><br>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="takmicenje" class=" form-control-label"><b>Takmičenje</b></label></div>
                            <div class="col-9 col-md-4">
                              <select name="takmicenje" id="takmicenje" class="form-control">
                                <option value="">Izaberite takmičenje</option>
                                @foreach($competitions as $c)
                                  <option value="{{$c->id}}" {{(old('takmicenje')==$c->id)? 'selected' : '' }}> {{$c->name}} </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="runda" class=" form-control-label"><b>Runda</b></label></div>
                            <div class="col-9 col-md-4"><input type="text" id="runda" name="runda" placeholder="Runda" class="form-control" value="{{old('runda')}}"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="sezona" class=" form-control-label"><b>Sezona</b></label></div>
                            <div class="col-9 col-md-3">
                              <select name="sezona" id="sezona" class="form-control">
                                <option value="">Izaberite sezonu</option>
                                @foreach($seasons as $s)
                                  <option value="{{$s->id}}" selected> {{$s->year}} </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="strelci_d" class=" form-control-label"><b>Strelci za domaćina</b></label></div>
                            <div class="col-9 col-md-6">
                              <textarea style="font-size: 13px;" id="strelci_d" name="strelci_d" class="form-control" value="{{old('strelci_d')}}"></textarea>
                              <small class="form-text text-muted">* Polje nije obavezno</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="strelci_g" class=" form-control-label"><b>Strelci za gosta</b></label></div>
                            <div class="col-9 col-md-6">
                              <textarea style="font-size: 13px;" id="strelci_g" name="strelci_g" class="form-control" value="{{old('strelci_g')}}"></textarea>
                              <small class="form-text text-muted">* Polje nije obavezno</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="highlights" class=" form-control-label"><b>Highlights</b></label></div>
                            <div class="col-9 col-md-6">
                              <input type="text" id="highlights" name="highlights" placeholder="Link za highlights-e" class="form-control" value="{{old('highlights')}}">
                              <small class="form-text text-muted">* Polje nije obavezno</small>
                            </div>

                          </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Dodaj utakmicu</button>
                        </form>
                      </div>
                      @if ($errors->any())
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