@extends('admin.pages.content')
@section('breadcrumbs')
  <li><a href="{{route('news.index')}}">News</a></li>
  <li class="active">Edit news</li>
@endsection
@section('content')

    <div class="animated fadeIn">

    	<div class="row">
    		<div class="col col-md-1">
          </div>

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <strong><h5>Izmena vesti</h5></strong>
                    </div>
                      <div class="card-body card-block">
                        <form action="{{route('news.update', $news->id)}}" method="post" class="form-horizontal">
                          {{ csrf_field() }}
                          @method('PUT')
                          <div class="row form-group">
                            <div class="col-6 col-md-6"><input type="text" id="naslov" name="naslov" placeholder="Naslov" value="{{$news->title}}" class="form-control"></div>
                            <div class="col-6 col-md-6"><input type="text" id="slika" name="slika" value="{{$news->cover_image}}" class="form-control"></div>
                          </div>
                          <textarea class="form-control" id="summernote" name="editordata">{!! $news->body !!}</textarea>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Izmeni vest</button>
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