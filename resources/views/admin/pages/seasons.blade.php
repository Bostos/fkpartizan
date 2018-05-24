@extends('admin.pages.content')
@section('page_heading','Pregled svih sezona')
@section('breadcrumbs')
  <li class="active">Seasons</li>
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
                        <strong class="card-title">Sezone</strong>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sezona</th>
                                    <th>Izmena</th>
                                    <th>Brisanje</th>
                                  </tr>
                            </thead>
                            <tbody>
                             @foreach($seasons as $s)
                                <tr>
                                    <td>{{$s->year}}</td>
                                    <td><a href="{{route('seasons.edit', $s->id)}}" class="btn btn-primary btn-block">IZMENI</a></td>
                                    <td>
                                        <form action="{{route('seasons.destroy', $s->id)}}" method="post">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-block btn-warning">OBRIŠI</a>
                                        </form>
                                    </td>
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
