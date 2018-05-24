@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('clubs.index')}}">Clubs</a></li>
  <li class="active">Edit club</li>
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
          </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Izmena kluba</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('clubs.update', $club->id)}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          @method('PUT')
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="naziv" class="form-control-label mt-1"><b>Naziv</b></label></div>
                            <div class="col-9 col-md-4"><input type="text" id="naziv" name="naziv" placeholder="Naziv" class="form-control" value="{{$club->name}}"></div>
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Izmeni klub</button>
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