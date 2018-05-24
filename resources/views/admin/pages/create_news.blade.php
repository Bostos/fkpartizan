@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('news.index')}}">News</a></li>
  <li class="active">Add news</li>
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
        	<div class="col col-md-1">
          </div>

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Dodavanje vesti</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('news.store')}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          <div class="row form-group">
                            <div class="col-6 col-md-6"><input type="text" id="naslov" name="naslov" placeholder="Naslov" value="{{old('naslov')}}" class="form-control"></div>
                            <div class="col-6 col-md-6"><input type="text" id="slika" name="slika" placeholder="Link za cover sliku" value="{{old('slika')}}" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col-6 col-md-6"><input type="text" id="izvor" name="izvor" placeholder="Izvor" value="{{old('izvor')}}" class="form-control"></div>
                            <div class="col-6 col-md-6"><input type="date" id="datum" name="datum" value="{{old('datum')}}" class="form-control"></div>
                          </div>
                          <textarea class="form-control" id="summernote" name="editordata"></textarea>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Dodaj vest</button>
                        </form>
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

@section('script')
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script> -->
<script type="text/javascript" src="{{asset('dist/summernote-bs4.min.js')}}"></script>
<script>
    jQuery(function($){
        $('#summernote').summernote({
          height: 500,                 // set editor height
          minHeight: 500,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor
          focus: true,                // set focus to editable area after initializing summernote
          dialogsInBody: true,
          fontNames: ['Arial', 'Arial Black', 'Oswald', 'Roboto', 'Times New Roman'],
          fontNamesIgnoreCheck: ['Oswald', 'Roboto'],
          toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontname', ['fontname']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'hr']],
          ['view', ['fullscreen', 'codeview']],
          ['help', ['help']]
          ]               
        });
    });
</script>
@endsection