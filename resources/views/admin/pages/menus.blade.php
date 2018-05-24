@extends('admin.pages.content')
@section('page_heading','Pregled navigacionog menija')
@section('breadcrumbs')
  <li class="active">Menus</li>
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
                        <strong class="card-title">Navigacioni meni</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pozicija</th>
                                    <th>Naslov</th>
                                    <th>Putanja</th>
                                    <th>Roditelj</th>
                                    <th>Izmena</th>
                                  </tr>
                            </thead>
                            <tbody>
                             @foreach($menus as $m)
                                <tr>
                                    <td>{{$m->position}}</td>
                                    <td>{{$m->name}}</td>
                                    <td>{{$m->path}}</td>
                                    <td>{{$m->parent_id}}</td>
                                    <td><a href="{{route('menus.edit', $m->id)}}" class="btn btn-primary btn-block">IZMENI</a></td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        
    </div><!-- .animated -->
@endsection
