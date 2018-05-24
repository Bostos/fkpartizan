@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('tables.index')}}">Tables</a></li>
  <li class="active">Display</li>
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
            <div class="col col-md-2">
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <b><h4 align="center">{{$table->name}} ({{$table->season}})</h4></b>
                    </div>
                    <div class="card-body card-block">
                      {!! $table->data !!}
                    </div>
                    <div class="card-footer">
                      Poslednja izmena: {{date('d.m.Y', strtotime($table->updated_at))}}. u {{date('H:i:s', strtotime($table->updated_at))}}
                    </div>
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

    </div><!-- .animated -->

@endsection