@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('clubs.index')}}">Clubs</a></li>
  <li class="active">Add club</li>
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
                        <strong>Dodavanje kluba</strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('clubs.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                          {{ csrf_field() }}
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="ime" class=" form-control-label">Ime kluba</label></div>
                            <div class="col-9 col-md-6"><input type="text" id="im" name="ime" placeholder="Ime" value="{{old('ime')}}" class="form-control"></div>
                          </div>
                          
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="logo" class=" form-control-label">Logo</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="logo" name="logo" class="form-control-file"></div>
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