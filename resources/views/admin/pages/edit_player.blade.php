@extends('admin.pages.content')
@section('page_heading','Izmena igrača')
@section('breadcrumbs')
  <li><a href="{{route('display-all-players')}}">Players</a></li>
  <li class="active">Edit player</li>
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
          
          <!-- Blok avatar -->
        	<div class="col col-md-3">
            <div class="card">
              <div class="card-header">
                <strong class="card-title mb-3">Avatar</strong>
              </div>
              <div class="card-body">
                <div class="mx-auto d-block">
                  <img class="rounded-circle mx-auto d-block" src="{{asset($avatar->path)}}" alt="{{$avatar->name}}">
                  <h5 class="text-sm-center mt-2 mb-1">{{$player->name}}</h5>
                  <div class="location text-sm-center"><h5># {{$player->number}}</h5></div>
                </div>
              </div>
              <div class="card-footer">
                <a href="{{route('photos.edit', $player->avatar_id)}}" class="btn btn-primary btn btn-block">PROMENI</a>
              </div>
            </div>
          </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Izmena igrača</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('do-edit-player', $player->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                          {{ csrf_field() }}
                          @method('PUT')
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="ime_prezime" class=" form-control-label">Ime i prezime</label></div>
                            <div class="col-9 col-md-6"><input type="text" id="ime_prezime" name="ime_prezime" placeholder="Ime i prezime" class="form-control" value="{{$player->name}}"></div>
                          </div>
                          
                          <div class="row form-group">
                            <div class="col col-md-3"><label for=datum" class=" form-control-label">Datum rođenja</label></div>
                            <div class="col-9 col-md-6"><input type="date" id="datum" name="datum" class="form-control" value="{{$player->birth_date}}"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="drzava" class=" form-control-label">Država</label></div>
                            <div class="col-9 col-md-6"><input type="text" id="drzava" name="drzava" placeholder="Država" class="form-control" value="{{$player->country}}"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="prvi_nastup" class=" form-control-label">Prvi nastup</label></div>
                            <div class="col-9 col-md-6"><input type="text" id="prvi_nastup" name="prvi_nastup" placeholder="dd/mm/yy TeamA 1-0 TeamB" class="form-control" value="{{$player->debut}}"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="broj" class=" form-control-label">Broj</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="broj" name="broj" class="form-control" value="{{$player->number}}"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="visina" class=" form-control-label">Visina</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="visina" name="visina" class="form-control" value="{{$player->height}}"></div>
                          </div>
                          <div class="row form-group">
                          	<div class="col col-md-3"><label for="tezina" class=" form-control-label">Težina</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="tezina" name="tezina" class="form-control" value="{{$player->weight}}"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="nastupi" class=" form-control-label">Nastupi</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="nastupi" name="nastupi" class="form-control" value="{{$player->apps}}"></div>
                            <div class="col-9 col-md-4"><small class="form-text text-muted">Računaju se samo nastupi u domaćem prvenstvu.</small></div>
                          </div>
                          <div class="row form-group">
                          	<div class="col col-md-3"><label for="golovi" class=" form-control-label">Golovi</label></div>
                            <div class="col-9 col-md-2"><input type="number" id="golovi" name="golovi" class="form-control" value="{{$player->goals}}"></div>
                            <div class="col-9 col-md-4"><small class="form-text text-muted">Računaju se samo golovi u domaćem prvenstvu.</small></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="prethodni_klub" class=" form-control-label">Prethodni klub</label></div>
                            <div class="col-9 col-md-6"><input type="text" id="prethodni_klub" name="prethodni_klub" placeholder="Prethodni klub" class="form-control" value="{{$player->previous_club}}"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="pozicija" class=" form-control-label">Pozicija</label></div>
                            <div class="col-9 col-md-6">
                              <select name="pozicija" id="pozicija" class="form-control">
                                <option value="0">Izaberite poziciju</option>
                                <option value="Golman" @if($player->position=='Golman') {{'selected'}} @endif> Golman</option>
                                <option value="Štoper" @if($player->position=='Štoper') {{'selected'}} @endif> Štoper</option>
                                <option value="Levi bek" @if($player->position=='Levi bek') {{'selected'}} @endif> Levi bek</option>
                                <option value="Desni bek" @if($player->position=='Desni bek') {{'selected'}} @endif> Desni bek</option>
                                <option value="Defanzivni vezni" @if($player->position=='Defanzivni vezni') {{'selected'}} @endif> Defanzivni vezni</option>
                                <option value="Sredina" @if($player->position=='Sredina') {{'selected'}} @endif> Sredina</option>
                                <option value="Ofanzivni vezni" @if($player->position=='Ofanzivni vezni') {{'selected'}} @endif> Ofanzivni vezni</option>
                                <option value="Napadač" @if($player->position=='Napadač') {{'selected'}} @endif >Napadač</option>
                              </select>
                            </div>
                          </div>
                          
                          <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Status</label></div>
                            <div class="col col-md-9">
                              <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="status1" name="status" value="Prvi tim" class="form-check-input" @if($player->status=='Prvi tim') {{'checked'}} @endif>Prvi tim 
                                </label>
                                <label for="inline-radio2" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="status2" name="status" value="Pozajmljen" class="form-check-input" @if($player->status=='Pozajmljen') {{'checked'}} @endif>Pozajmljen 
                                </label>
                                <label for="inline-radio3" class="form-check-label">
                                  <input type="radio" id="status3" name="status" value="Bivši igrač" class="form-check-input" @if($player->status=='Bivši igrač') {{'checked'}} @endif>Bivši igrač 
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for=datum_dolaska" class=" form-control-label">Datum dolaska</label></div>
                            <div class="col-9 col-md-6"><input type="date" id="datum_dolaska" name="datum_dolaska" class="form-control" value="{{$player->date_of_signing}}"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for=datum_odlaska" class=" form-control-label" value="{{$player->date_of_leaving}}">Datum odlaska</label></div>
                            <div class="col-9 col-md-6">
                            	<input type="date" id="datum_odlaska" name="datum_odlaska" class="form-control">
                            	<small class="form-text text-muted">Datum popuniti samo pri dodavanju bivših igrača</small>
                            </div>
                          </div>
                          <!-- <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Avatar slika</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="avatar" name="avatar" class="form-control-file"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Cover slika</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="cover" name="cover" class="form-control-file"></div>
                          </div> -->
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Izmeni</button>
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