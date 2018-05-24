@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('seasons.index')}}">Seasons</a></li>
  <li class="active">Create season</li>
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
          
          <div class="col col-md-4">
          </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Dodavanje sezone</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('seasons.store')}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="sezona" class=" form-control-label"><b>Sezona</b></label></div>
                            <div class="col-9 col-md-9"><input type="text" id="sezona" name="sezona" placeholder="20xx/xx" value="{{old('sezona')}}" class="form-control"></div>
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

            <div class="col-md-4"></div>
          </div>
    </div><!-- .animated -->
@endsection