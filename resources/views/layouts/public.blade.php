<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>@yield('title','') | Bayregistry</title>
	<!-- initiate head with meta tags, css and script -->
	@include('include.head')

</head>
<body id="app">
    <div class="wrapper">
    	<!-- initiate header-->
	

	    	<div class="main-content">
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	</div>

	    	<!-- initiate footer section-->
	    	@include('include.footer')

    </div>
    

	<!-- initiate scripts-->
	@include('include.script')	
</body>
</html>