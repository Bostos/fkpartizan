<!doctype html>
<html>
	
	@include('components.head')

	<body>

		<div class="container-fluid">
			
			@include('components.header')

			@include('components.nav')

			<main role="main">

				@yield('content')
				
			</main>

		</div>

		@include('components.footer')

		@include('components.scripts')
		
	</body>

</html>