@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('goals.index')}}">Goals</a></li>
  <li class="active">Edit goal</li>
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
                        <strong><h5>Izmena gola</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('goals.update', $goal->id)}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          @method('PUT')
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="minut" class=" form-control-label"><b>Minut</b></label></div>
                            <div class="col-9 col-md-2"><input type="number" id="minut" name="minut" class="form-control" value="{{$goal->minute}}"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label"><b>Tip</b></label></div>
                            <div class="col col-md-9">
                              <div class="form-check-inline form-check">
                                <label for="tip1" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="tip1" name="tip" value="Iz igre" class="form-check-input" @if($goal->type=='Iz igre') {{'checked'}} @endif>Iz igre 
                                </label>
                                <label for="tip2" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="tip2" name="tip" value="Posle prekida" class="form-check-input" @if($goal->type=='Posle prekida') {{'checked'}} @endif>Posle prekida 
                                </label>
                                <label for="tip3" class="form-check-label" style="margin-right: 10px;">
                                  <input type="radio" id="tip3" name="tip" value="Slobodan udarac" class="form-check-input" @if($goal->type=='Slobodan udarac') {{'checked'}} @endif>Slobodan udarac
                                </label>
                                </label>
                                <label for="tip4" class="form-check-label">
                                  <input type="radio" id="tip4" name="tip" value="Kazneni udarac" class="form-check-input" @if($goal->type=='Kazneni udarac') {{'checked'}} @endif>Kazneni udarac 
                                </label>
                              </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Izmeni gol</button>
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