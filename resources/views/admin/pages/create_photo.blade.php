@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('photos.index')}}">Photos</a></li>
  <li class="active">Add photo</li>
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
          
          <!-- Blok avatar -->
        	<div class="col col-md-3"></div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Dodavanje slike</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('photos.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="naslov" class=" form-control-label"><b>Naslov</b></label></div>
                            <div class="col-9 col-md-5"><input type="text" id="naslov" name="naslov" placeholder="Naslov" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="tip" class=" form-control-label"><b>Tip slike</b></label></div>
                            <div class="col-9 col-md-4">
                              <select name="tip" id="tip" class="form-control">
                                <option value="">Izaberite tip slike</option>
                                <option value="avatar" @if(old('tip')=='avatar') {{'selected'}} @endif>Avatar</option>
                                <option value="cover" @if(old('tip')=='cover') {{'selected'}} @endif>Cover</option>
                                <option value="logo" @if(old('tip')=='logo') {{'selected'}} @endif>Logo</option>
                                <option value="flag" @if(old('tip')=='flag') {{'selected'}} @endif>Zastava</option>
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="slika" class=" form-control-label"><b>Slika</b></label></div>
                            <div class="col-9 col-md-5"><input type="file" id="slika" name="slika" class="form-control"></div>
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Dodaj sliku</button>
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