@extends('admin.pages.content')
@section('page_heading','Pregled svih slika')
@section('breadcrumbs')
  <li class="active">Photos</li>
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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Slike</h4>
                    </div>
                    <div class="card-body">
                        <div class="default-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-avatars-tab" data-toggle="tab" href="#nav-avatars" role="tab" aria-controls="nav-havatars" aria-selected="true">Avatars</a>
                                    <a class="nav-item nav-link" id="nav-covers-tab" data-toggle="tab" href="#nav-covers" role="tab" aria-controls="nav-covers" aria-selected="false">Covers</a>
                                    <a class="nav-item nav-link" id="nav-logos-tab" data-toggle="tab" href="#nav-logos" role="tab" aria-controls="nav-logos" aria-selected="false">Logos</a>
                                    <a class="nav-item nav-link" id="nav-flags-tab" data-toggle="tab" href="#nav-flags" role="tab" aria-controls="nav-flags" aria-selected="false">Flags</a>
                                </div>
                            </nav>

                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav-avatars" role="tabpanel" aria-labelledby="nav-avatars-tab">
                                    @foreach($avatars as $a)
                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mx-auto d-block">
                                                    <img class="rounded-circle mx-auto d-block" style="width: 175px; height: 200px;" src="{{asset($a->path)}}" alt="{{$a->name}}">
                                                    <h5 class="text-sm-center mt-2 mb-1">{{$a->name}}</h5>
                                                    <div class="location text-sm-center"></div>
                                                </div>
                                                <hr>
                                                <div class="card-text text-sm-center" style="font-size: 12px;">
                                                    Putanja fajla: {{$a->path}}<br>
                                                </div>
                                            </div>
                                            <div class="card-footer" style="height: 50px;">
                                                <p style="font-size: 12px;">Last update: {{date_format($a->updated_at, 'd.m.Y H:i:s')}}</p>
                                            </div>
                                            <a href="{{route('photos.edit', $a->id)}}" class="btn btn-primary btn btn-block">PROMENI</a>
                                            <a href="{{route('photos.destroy', $a->id)}}" class="btn btn-warning btn btn-block" data-toggle="modal" data-target="#modalAvatar-{{$a->id}}">OBRIŠI</a>
                                        </div>
                                    </div>
                                    <!-- /jedan blok -->
                                    @endforeach
                                </div>
                                <!-- /jedan panel-->
                                

                                <div class="tab-pane fade" id="nav-covers" role="tabpanel" aria-labelledby="nav-covers-tab">
                                    @foreach($covers as $c)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img class="card-img-top" src="{{asset($c->path)}}" alt="{{$c->name}}">
                                            <div class="card-body">
                                                <h4 class="card-title mb-3">{{$c->name}}</h4>
                                                <p class="card-text" style="font-size: 12px;">Putanja: {{$c->path}}</p>
                                            </div>
                                            <div class="card-footer" style="height: 50px;">
                                                <p style="font-size: 12px;">Last update: {{date_format($c->updated_at, 'd.m.Y H:i:s')}}</p>
                                            </div>
                                            <a href="{{route('photos.edit', $c->id)}}" class="btn btn-primary btn btn-block">PROMENI</a>
                                            <a href="{{route('photos.destroy', $c->id)}}" class="btn btn-warning btn btn-block" data-toggle="modal" data-target="#modalCover-{{$c->id}}">OBRIŠI</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- /jedan panel-->

                                <div class="tab-pane fade" id="nav-logos" role="tabpanel" aria-labelledby="nav-logos-tab">
                                    <div class="row form-group">
                                        <div class="col-md-9">
                                            <div class="col-3 col-md-4">
                                                <label for="logoSearch" class=" form-control-label"><b>Pretraga</b></label>
                                                <input class="form-control" type="text" id="logoSearch" name="logoSearch" placeholder="search"><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="card">
                                        @foreach($logos as $l)
                                        <div class="col-md-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mx-auto d-block">
                                                        <img class="mx-auto d-block" style="width: 100px; height: 100px;" src="{{asset($l->path)}}" alt="{{$l->name}}">
                                                        <h5 class="text-sm-center mt-2 mb-1">{{$l->name}}</h5>
                                                        <div class="location text-sm-center"></div>
                                                    </div>
                                                    <hr>
                                                    <div class="card-text text-sm-center" style="font-size: 12px;">
                                                        Putanja fajla: {{$l->path}}<br>
                                                    </div>
                                                </div>
                                                <div class="card-footer" style="height: 50px;">
                                                    <p style="font-size: 12px;">Last update: {{date_format($l->updated_at, 'd.m.Y H:i:s')}}</p>
                                                </div>
                                                <a href="{{route('photos.edit', $l->id)}}" class="btn btn-primary btn btn-block">PROMENI</a>
                                                <a href="{{route('photos.destroy', $l->id)}}" class="btn btn-warning btn btn-block" data-toggle="modal" data-target="#modalLogo-{{$l->id}}">OBRIŠI</a>
                                            </div>
                                        </div>
                                        <!-- /jedan blok -->
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /jedan panel-->

                                <div class="tab-pane fade" id="nav-flags" role="tabpanel" aria-labelledby="nav-flags-tab">
                                    @foreach($flags as $f)
                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mx-auto d-block">
                                                    <img class="mx-auto d-block" style="width: 50px; height: 50px;" src="{{asset($f->path)}}" alt="{{$f->name}}">
                                                    <h5 class="text-sm-center mt-2 mb-1">{{$f->name}}</h5>
                                                    <div class="location text-sm-center"></div>
                                                </div>
                                                <hr>
                                                <div class="card-text text-sm-center" style="font-size: 12px;">
                                                    Putanja fajla: {{$f->path}}<br>
                                                </div>
                                            </div>
                                            <div class="card-footer" style="height: 50px;">
                                                <p style="font-size: 12px;">Last update: {{date_format($f->updated_at, 'd.m.Y H:i:s')}}</p>
                                            </div>
                                            <a href="{{route('photos.edit', $f->id)}}" class="btn btn-primary btn btn-block">PROMENI</a>
                                            <a href="{{route('photos.destroy', $f->id)}}" class="btn btn-warning btn btn-block" data-toggle="modal" data-target="#modalFlag-{{$f->id}}">OBRIŠI</a>
                                        </div>
                                    </div>
                                    <!-- /jedan blok -->
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- .animated -->

    

    <!-- Modal dialog Avatar -->
    @foreach($avatars as $a)
    <div class="modal fade" id="modalAvatar-{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Brisanje avatara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Da li ste sigurni da želite da obrišete ovu sliku?</p>
                    <img style="width: 80px; height:90px; margin-left: 35%;" src="{{asset($a->path)}}"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                    <form action="{{route('photos.destroy', $a->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Potvrdi</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($covers as $c)
    <!-- Modal dialog Cover-->
    <div class="modal fade" id="modalCover-{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Brisanje covera</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Da li ste sigurni da želite da obrišete ovaj cover?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                    <form action="{{route('photos.destroy', $c->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Potvrdi</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($logos as $l)
    <!-- Modal dialog Logo-->
    <div class="modal fade" id="modalLogo-{{$l->id}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Brisanje logoa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Da li ste sigurni da želite da obrišete ovaj logo?</p>
                    <img style="width: 60px; height:60px; margin-left: 40%;" src="{{asset($l->path)}}"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                    <form action="{{route('photos.destroy', $l->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Potvrdi</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($flags as $f)
    <!-- Modal dialog Logo-->
    <div class="modal fade" id="modalFlag-{{$f->id}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Brisanje zastave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Da li ste sigurni da želite da obrišete ovu zastavu?</p>
                    <img style="width: 60px; height:60px; margin-left: 38%;" src="{{asset($f->path)}}"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                    <form action="{{route('photos.destroy', $f->id)}}" method="post">
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
