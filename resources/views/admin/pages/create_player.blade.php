@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('display-all-players')}}">Players</a></li>
  <li class="active">Add player</li>
@endsection
@section('content')

    <div class="animated fadeIn">
    	<div class="row">
    		<div class="col-md-3"></div>
    		<div class="col-md-6">
    			@if(session('success'))
    				<div class="alert alert-success alert-dismissible fade show" role="alert">
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
        	<div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>Dodavanje igrača</strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('do-add-player')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                          {{ csrf_field() }}
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="ime_prezime" class=" form-control-label">Ime i prezime</label></div>
                            <div class="col-9 col-md-6"><input type="text" id="ime_prezime" name="ime_prezime" placeholder="Ime i prezime" value="{{old('ime_prezime')}}" class="form-control"></div>
                          </div>
                          
                          <div class="row form-group">
                            <div class="col col-md-3"><label for=datum" class=" form-control-label">Datum rođenja</label></div>
                            <div class="col-9 col-md-6"><input type="date" id="datum" name="datum" class="form-control" value="{{old('datum')}}"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="drzava" class=" form-control-label">Država</label></div>
                            <div class="col-9 col-md-6"><input type="text" id="drzava" name="drzava" placeholder="Država" value="{{old('drzava')}}" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="prvi_nastup" class=" form-control-label">Prvi nastup</label></div>
                            <div class="col-9 col-md-6"><input type="text" id="prvi_nastup" name="prvi_nastup" placeholder="dd/mm/yy TeamA 1-0 TeamB" value="{{old('prvi_nastup')}}" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="broj" class=" form-control-label">Broj</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="broj" name="broj" class="form-control" value="{{old('broj')}}"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="visina" class=" form-control-label">Visina</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="visina" name="visina" value="{{old('visina')}}" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                          	<div class="col col-md-3"><label for="tezina" class=" form-control-label">Težina</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="tezina" name="tezina" value="{{old('tezina')}}" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="nastupi" class=" form-control-label">Nastupi</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="nastupi" name="nastupi" value="{{old('nastupi')}}" class="form-control"></div>
                            <div class="col-9 col-md-4"><small class="form-text text-muted">Računaju se samo nastupi u domaćem prvenstvu.</small></div>
                          </div>
                          <div class="row form-group">
                          	<div class="col col-md-3"><label for="golovi" class=" form-control-label">Golovi</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="golovi" name="golovi" value="{{old('golovi')}}" class="form-control"></div>
                            <div class="col-9 col-md-4"><small class="form-text text-muted">Računaju se samo golovi u domaćem prvenstvu.</small></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="prethodni_klub" class=" form-control-label">Prethodni klub</label></div>
                            <div class="col-9 col-md-6"><input type="text" id="prethodni_klub" name="prethodni_klub" placeholder="Prethodni klub" value="{{old('prethodni_klub')}}" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="pozicija" class=" form-control-label">Pozicija</label></div>
                            <div class="col-9 col-md-6">
                              <select name="pozicija" id="pozicija" class="form-control">
                                <option value="">Izaberite poziciju</option>
                                <option value="Golman" @if(old('pozicija')=='Golman') {{'selected'}} @endif>Golman</option>
                                <option value="Štoper" @if(old('pozicija')=='Štoper') {{'selected'}} @endif>Štoper</option>
                                <option value="Levi bek" @if(old('pozicija')=='Levi bek') {{'selected'}} @endif>Levi bek</option>
                                <option value="Desni bek" @if(old('pozicija')=='Desni bek') {{'selected'}} @endif>Desni bek</option>
                                <option value="Defanzivni vezni" @if(old('pozicija')=='Defanzivni vezni') {{'selected'}} @endif>Defanzivni vezni</option>
                                <option value="Sredina" @if(old('pozicija')=='Sredina') {{'selected'}} @endif>Sredina</option>
                                <option value="Ofanzivni vezni" @if(old('pozicija')=='Ofanzivni vezni') {{'selected'}} @endif>Ofanzivni vezni</option>
                                <option value="Napadač" @if(old('pozicija')=='Napadač') {{'selected'}} @endif>Napadač</option>
                              </select>
                            </div>
                          </div>
                          
                          <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Status</label></div>
                            <div class="col col-md-9">
                              <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="status1" name="status" value="Prvi tim" class="form-check-input" @if(old('status')=='Prvi tim') {{'checked'}} @endif>Prvi tim 
                                </label>
                                <label for="inline-radio2" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="status2" name="status" value="Pozajmljen" class="form-check-input" @if(old('status')=='Pozajmljen') {{'checked'}} @endif>Pozajmljen 
                                </label>
                                <label for="inline-radio3" class="form-check-label">
                                  <input type="radio" id="status3" name="status" value="Bivši igrač" class="form-check-input" @if(old('status')=='Bivši igrač') {{'checked'}} @endif>Bivši igrač 
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for=datum_dolaska" class=" form-control-label">Datum dolaska</label></div>
                            <div class="col-9 col-md-6"><input type="date" id="datum_dolaska" name="datum_dolaska" value="{{old('datum_dolaska')}}" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for=datum_odlaska" class=" form-control-label">Datum odlaska</label></div>
                            <div class="col-9 col-md-6">
                            	<input type="date" id="datum_odlaska" name="datum_odlaska" value="{{old('datum_odlaska')}}" class="form-control">
                            	<small class="form-text text-muted">Datum popuniti samo pri dodavanju bivših igrača</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Avatar slika</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="avatar" name="avatar" class="form-control-file"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Cover slika</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="cover" name="cover" class="form-control-file"></div>
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Dodaj</button>
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