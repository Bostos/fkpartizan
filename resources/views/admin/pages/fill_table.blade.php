@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('tables.index')}}">Tables</a></li>
  <li class="active">Fill table</li>
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
    		<div class="col col-md-4">
          </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Popuna tabele</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('tables.storeFill', $table->id)}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="klub" class=" form-control-label"><b>Klub</b></label></div>
                            <div class="col-9 col-md-9">
                              <select name="klub" id="klub" class="form-control">
                                <option value="">Izaberite klub</option>
                                @foreach($clubs as $c)
                                  <option value="{{$c->id}}" {{(old('klub')==$c->id)? 'selected' : '' }}> {{$c->name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Dodaj</button>
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