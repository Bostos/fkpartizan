<!-- Navigacioni meni -->
<div class="row" style="background-color: black;">
	<div class="col-3"></div>
	<div class="col-6">
		<nav class="nav d-flex justify-content-left navigation">
			@foreach($nav as $item)
				@if($item->has_children==null)
					<a href="{{asset($item->path)}}" class="{{(Route::currentRouteName()==$item->path)? 'active-link' : '' }}">{{strtoupper($item->name)}}</a>
				@else
					<div class="dropdown">
						<a class="dropbtn" href="{{asset($item->path)}}" class="{{(Route::currentRouteName()==$item->path)? 'active-link' : '' }}">{{$item->name}}</a>
						<div class="dropdown-content">
							@foreach($item['children'] as $child)
								<a href="{{asset($child->path)}}">{{$child->name}}</a>
							@endforeach
						</div>
					</div>	
				@endif
			@endforeach
		</nav>
	</div>
</div>