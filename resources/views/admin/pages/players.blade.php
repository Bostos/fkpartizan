@extends('admin.pages.content')
@section('page_heading','Pregled svih igrača')
@section('breadcrumbs')
  <li class="active">Players</li>
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
          <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><strong class="card-title">Filteri</strong></div>
                    <div class="card-header">
                        <form class="form-horizontal" method="get" action="{{ route('players.filter') }}">
                            <div class="row form-group">
                              <label for="pozicija" class="col-sm-1 col-form-label-sm"><b>Pozicija:</b></label>
                              <div class="col-2 col-md-2">
                                  <select name="pozicija" id="pozicija" class="form-control form-control-sm">
                                    <option value="">Sve pozicije</option>
                                    @foreach($positions as $p)
                                    <option value="{{$p->name}}" {{ (old("pozicija") == $p->name ? "selected":"") }}> {{$p->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <label for="status" class="col-sm-1 col-form-label-sm"><b>Status:</b></label>
                              <div class="col-2 col-md-2">
                                  <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="">Svi igrači</option>
                                    @foreach($status as $s)
                                    <option value="{{$s->name}}" {{ (old("status") == $s->name ? "selected":"") }}> {{$s->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <label for="drzava" class="col-sm-1 col-form-label-sm"><b>Država:</b></label>
                              <div class="col-2 col-md-2">
                                  <select name="drzava" id="drzava" class="form-control form-control-sm">
                                    <option value="">Sve države</option>
                                    @foreach($countries as $c)
                                    <option value="{{$c->country}}" {{ (old("drzava") == $c->country ? "selected":"") }}> {{$c->country}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-primary btn-sm mb-2">Primeni</button>
                           </div>
                        </form>
                    </div>
                </div>   
            </div>   
        </div>

        <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                      <form id="sortForm" method="get" action="{{route('display-all-players')}}">
                        <div class="form-group row">
                            <label for="sezona" class="col-sm-1 col-form-label"><b>Sortiraj:</b></label>
                            <div class="col-sm-2">
                            <select name="sort" id="sort" class="form-control form-control-sm">
                              <option value="">Izaberi...</option>
                              <option value="number" {{ (old("sort") == "number" ? "selected":"") }} >Broj na dresu</option>
                              <option value="birth_date" {{ (old("sort") == "birth_date" ? "selected":"") }} >Datum rođenja</option>
                              <option value="apps" {{ (old("sort") == "apps" ? "selected":"") }} >Nastupi</option>
                              <option value="goals" {{ (old("sort") == "goals" ? "selected":"") }} >Golovi</option>
                              <option value="height" {{ (old("sort") == "height" ? "selected":"") }} >Visina</option>
                              <option value="weight" {{ (old("sort") == "weight" ? "selected":"") }} >Težina</option>
                            </select>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="card-body">
                      @isset($info)
                        <div class="alert alert-warning">{{$info}}</div>
                      @endisset

                      @if(count($players)!=0)
		                  <table class="table table-striped table-bordered">
		                    <thead>
		                      <tr>
		                      	<th>#</th>
		                        <th>Ime</th>
		                        <th>Pozicija</th>
		                        <th>Datum rođenja</th>
		                        <th>Država</th>
		                        <th>Status</th>
		                        <th>Broj nastupa</th>
		                        <th>Broj golova</th>
		                        <th>Visina/Težina</th>
		                        <th>Izmeni</th>
		                      </tr>
		                    </thead>
		                    <tbody>
		                      @foreach($players as $p)
		                    	<tr>
		                    	 <td>{{$p->number}}</td>
			                     <td>{{$p->name}}</td>
			                     <td>{{$p->position}}</td>
			                     <td>{{date('d.m.Y', strtotime($p->birth_date))}}</td>
			                     <td><img style="width: 20px; height: 20px;" src="{{asset($p->flag)}}"/> {{$p->country}}</td>
			                     <td>{{$p->status}}</td>
			                     <td>{{$p->apps}}</td>
			                     <td>{{$p->goals}}</td>
			                     <td>{{$p->height}}cm / {{$p->weight}}kg</td>
			                     <td><a href="{{route('display-edit-form', $p->id)}}">EDIT</a></td>
		                      	</tr>
		                      @endforeach
		                    </tbody>
		                </table>
                    @endif
                    </div>
                </div>
            </div>
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

          $('#sort').change(function(){
            $('#sortForm').submit();
          });
        } );
    </script>
@endsection