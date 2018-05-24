@extends('admin.pages.content')
@section('page_heading','Pregled svih tabela')
@section('breadcrumbs')
  <li class="active">Tables</li>
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
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tabele</strong>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Naziv</th>
                                    <th>Sezona</th>
                                    <th>Popuna</th>
                                    <th>Izmena</th>
                                    <th>Brisanje</th>
                                  </tr>
                            </thead>
                            <tbody>
                         @foreach($tables as $t)
                            <tr>
                                <td>{{$t->name}}</td>
                                <td>{{$t->season}}</td>
                                <td><a href="{{route('tables.createFill', $t->id)}}" class="btn btn-submit btn-block">POPUNI</a></td>
                                <td><a href="{{route('tables.edit', $t->id)}}" class="btn btn-primary btn-block">IZMENI</a></td>
                                <td><a href="{{route('tables.destroy', $t->id)}}" class="btn btn-warning btn-block">OBRIŠI</a></td>
                            </tr>
                         @endforeach
                            </tbody>
                         </table>

                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        
    </div><!-- .animated -->
@endsection
