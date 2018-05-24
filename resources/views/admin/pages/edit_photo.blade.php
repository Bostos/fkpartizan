@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('photos.index')}}">Photoss</a></li>
  <li class="active">Edit photo</li>
@endsection
@section('content')

    <div class="animated fadeIn">

        <div class="row">
          
          <!-- Blok avatar -->
        	<div class="col col-md-3">
          </div>

          <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Izmena slike</h5></strong>
                    </div>
                      <div class="card-body card-block">

                        @isset($avatar)
                        <form action="{{route('photos.update', $avatar->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          @method('PUT')
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="naslov" class=" form-control-label"><b>Naslov</b></label></div>
                            <div class="col-9 col-md-5"><input type="text" id="naslov" name="naslov" placeholder="Naslov" value="{{$avatar->name}}" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="avatar" class=" form-control-label"><b>Avatar</b></label></div>
                            <div class="col-9 col-md-5"><input type="file" id="avatar" name="avatar" class="form-control"></div>
                          </div>
                          <input type="hidden" name="tip" id="tip" value="avatar">
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Promeni avatar</button>
                        </form>
                        @endisset

                        @isset($cover)
                          <form action="{{route('photos.update', $cover->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          @method('PUT')
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="naslov" class=" form-control-label"><b>Naslov</b></label></div>
                            <div class="col-9 col-md-5"><input type="text" id="naslov" name="naslov" placeholder="Naslov" value="{{$cover->name}}" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="cover" class=" form-control-label"><b>Cover</b></label></div>
                            <div class="col-9 col-md-5"><input type="file" id="cover" name="cover" class="form-control"></div>
                          </div>
                          <input type="hidden" name="tip" id="tip" value="cover">
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Promeni cover</button>
                        </form>
                        @endisset

                        @isset($logo)
                          <form action="{{route('photos.update', $logo->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          @method('PUT')
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="naslov" class=" form-control-label"><b>Naslov</b></label></div>
                            <div class="col-9 col-md-5"><input type="text" id="naslov" name="naslov" placeholder="Naslov" value="{{$logo->name}}" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="logo" class=" form-control-label"><b>Logo</b></label></div>
                            <div class="col-9 col-md-5"><input type="file" id="logo" name="logo" class="form-control"></div>
                          </div>
                          <input type="hidden" name="tip" id="tip" value="logo">
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Promeni logo</button>
                        </form>
                        @endisset

                        @isset($flag)
                          <form action="{{route('photos.update', $flag->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          @method('PUT')
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="naslov" class=" form-control-label"><b>Naslov</b></label></div>
                            <div class="col-9 col-md-5"><input type="text" id="naslov" name="naslov" placeholder="Naslov" value="{{$flag->name}}" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="flag" class=" form-control-label"><b>Zastava</b></label></div>
                            <div class="col-9 col-md-5"><input type="file" id="flag" name="flag" class="form-control"></div>
                          </div>
                          <input type="hidden" name="tip" id="tip" value="flag">
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Promeni zastavu</button>
                        </form>
                        @endisset
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