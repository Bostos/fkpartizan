@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('tables.index')}}">Tables</a></li>
  <li class="active">Create table</li>
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
          
          <div class="col col-md-3">
          </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Dodavanje tabele</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('tables.store')}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          <div class="row form-group">
                            <div class="col-6 col-md-6"><input type="text" id="naslov" name="naslov" placeholder="Naziv" value="{{old('naslov')}}" class="form-control"></div>
                            <div class="col-6 col-md-6"><input type="text" id="sezona" name="sezona" placeholder="Sezona" value="{{old('sezona')}}" class="form-control"></div>
                          </div>
                          <div class="row form-check">
                            <div class="col-6 col-md-6"><label class="form-check-label" for="playoff">Da li je tabela za Play-off?</label></div>
                            <input type="checkbox" class="form-check-input" id="playoff" name="playoff">
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Dodaj tabelu</button>
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