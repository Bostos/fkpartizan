<header class="header">
	<div class="row flex-nowrap" style="background-color: black;">
		<div class="col-3"></div>
		<div class="col-6 d-flex justify-content-end top-nav">
			<a class="p-2" href="#"><div class="underline"><i class="fa fa-search" aria-hidden="true"></i>  Search</div></a>
			@if(session()->has('username') && session('role')=='admin')
				<a class="p-2" href="{{route('admin')}}"><div class="underline">Admin</div></a>
			@endif
			@if(session()->has('username'))
				<a class="p-2" href="{{route('logout')}}"><div class="underline">Logout</div></a>
			@else
				<a class="p-2" href="{{route('login')}}"><div class="underline">Login</div></a>
				<a class="p-2" href="{{route('register')}}"><div class="underline">Sign Up</div></a>
			@endif
		</div>
	</div>
	<div class="row flex-nowrap" style="background-color: white; color: black; height: 160px;">
		<div class="col-3"></div>
		<div class="col-6" style="border: 1px solid white;">
			PARTIZAN OFFICIAL WEBSITE
		</div>
	</div>
</header>