@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('tables.index')}}">Tables</a></li>
  <li class="active">Edit table</li>
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
    		<div class="col col-md-2">
          </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Izmena tabele</h5></strong>
                    </div>
                      <div class="card-body card-block">
                          <table class="table table-bordered">
                            <thead><tr align="center"><th>#</th><th>Club</th><th>M.</th><th>W.</th><th>D.</th><th>L.</th><th>G.D.</th><th>Pts.</th>@isset($table[0]->points_taken)<th>Pts.(-)</th>@endisset<th>Update</th></tr></thead>
                            <tbody>
                              @foreach($table as $t)
                              <form action="{{route('tables.update', $id)}}" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                                @method('PUT')
                                <tr align="center">
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$t->club}} <input type="hidden" name="club" value="{{$t->club}}"></td>
                                  <td>{{$t->matches}}</td>
                                  <td><input type="text" name="wins" style="border: none; width: 20px;" value="{{$t->wins}}"></td>
                                  <td><input type="text" name="draws" style="border: none; width: 20px;" value="{{$t->draws}}"></td>
                                  <td><input type="text" name="defeats" style="border: none; width: 20px;" value="{{$t->defeats}}"></td>
                                  <td><input type="text" name="goals_for" style="border: none; width: 20px;" value="{{$t->goals_for}}">:<input type="text" name="goals_against" style="border: none; width: 20px;" value="{{$t->goals_against}}"></td>
                                  <td>{{$t->points}}</td>
                                  @isset($t->points_taken)
                                  <td><input type="text" name="points_taken" style="border: none; width: 20px;" value="{{$t->points_taken}}"></td>
                                  @endisset
                                  <td><button type="submit" class="btn btn-submit btn-block">IZMENI</button></td>
                                </tr>
                              </form>
                              @endforeach
                            </tbody>
                          </table>
                      </div>

                      @if($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif
            </div>

            <div class="col-md-1"></div>
        </div>
    </div><!-- .animated -->
@endsection