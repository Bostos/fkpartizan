@extends('admin.pages.content')
@section('page_heading','Pregled svih vesti')
@section('breadcrumbs')
  <li class="active">News</li>
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
                        <strong class="card-title">News</strong>
                    </div>
                    <div class="card-body">
		                <table class="table table-bordered">
		                    <thead>
		                      <tr>
		                        <th>Naslov</th>
		                        <th>Datum</th>
		                        <th>Prikaz</th>
                                <th>Izmena</th>
		                      </tr>
		                    </thead>
		                    <tbody>
		                      @foreach($news as $n)
		                    	<tr>
			                     <td>{{$n->title}}</td>
			                     <td>{{date('d.m.Y', strtotime($n->date))}}.</td>
			                     <td><a href="{{route('news.show', $n->id)}}">PRIKAZ</a></td>
                                 <td><a href="{{route('news.edit', $n->id)}}">IZMENA</a></td>
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

@section('script')
    <script src="{{asset('js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{asset('js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/lib/data-table/jszip.min.js')}}"></script>
    <script src="{{asset('js/lib/data-table/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/lib/data-table/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/lib/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('js/lib/data-table/datatables-init.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
@endsection