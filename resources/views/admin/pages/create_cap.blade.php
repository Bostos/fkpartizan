@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('display-all-players')}}">Players</a></li>
  <li class="active">Add cap</li>
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
        	<div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>Dodavanje nastupa</strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('do-add-cap')}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          @foreach($players as $p)
                            <div class="col-md-4">
                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" name="igrac[]" value="{{$p->id}}">
                              <label class="form-check-label" for="igrac"><p style="font-size: 16px;">{{$p->name}}</p></label>
                            </div>
                          </div>
                          @endforeach
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Dodaj nastupe</button>
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