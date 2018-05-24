@extends('layouts.admin')
@section('body')

		@include('admin.components.left_panel')
    
    	<!-- Right Panel -->

    	<div id="right-panel" class="right-panel">

    		@include('admin.components.header')

    		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>@yield('page_heading')</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{route('admin')}}">Dashboard</a></li>
                            @yield('breadcrumbs')
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        	<div class="content mt-3">
        		@yield('content')
        	</div>
    		
    	</div><!-- /#right-panel -->

		<!-- Right Panel -->
        
        @include('admin.components.scripts')
@endsection