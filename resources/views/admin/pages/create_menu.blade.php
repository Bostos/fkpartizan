@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('menus.index')}}">Menus</a></li>
  <li class="active">Create menu</li>
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
          
          <div class="col col-md-3">
          </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Dodavanje menija</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('menus.store')}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="naziv" class=" form-control-label"><b>Naziv</b></label></div>
                            <div class="col-9 col-md-9"><input type="text" id="naziv" name="naziv" placeholder="Naziv" value="{{old('naziv')}}" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="putanja" class=" form-control-label"><b>Putanja</b></label></div>
                            <div class="col-9 col-md-9"><input type="text" id="putanja" name="putanja" placeholder="Putanja" value="{{old('putanja')}}" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="pozicija" class="form-control-label"><b>Pozicija</b></label></div>
                            <div class="col-9 col-md-2"><input type="number" id="pozicija" name="pozicija" value="{{old('putanja')}}" min="1" class="form-control"></div>
                            <div class="col col-md-3">
                              <label for="podmeni" class="form-control-label checkbox-inline"><b>Podmeni</b></label>
                              <input type="checkbox" id="podmeni" name="podmeni" value="1">
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="roditelj" class=" form-control-label"><b>Roditelj</b></label></div>
                            <div class="col-9 col-md-4">
                              <select name="roditelj" id="roditelj" class="form-control">
                                <option value="">Nema roditelja</option>
                                @foreach($menus as $m)
                                  <option value="{{$m->id}}"> {{$m->name}} </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Dodaj meni</button>
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

            <div class="col-md-1"></div>
          </div>
    </div><!-- .animated -->
@endsection