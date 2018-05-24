@extends('admin.pages.content')
@section('page_heading','Pregled svih klubova')
@section('breadcrumbs')
  <li class="active">Clubs</li>
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
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Klubovi</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Naziv</th>
                                    <th>Logo</th>
                                    <th>Izmena</th>
                                  </tr>
                            </thead>
                            <tbody>
                             @foreach($clubs as $c)
                                <tr>
                                    <td>{{$c->name}}</td>
                                    <td align="center" style="width: 100px;"><img style="width: 40px; height: 40px;" src="{{asset($c->path)}}"></td>
                                    <td style="width: 200px;"><a href="{{route('clubs.edit', $c->id)}}" class="btn btn-primary btn-block">IZMENI</a></td>
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
