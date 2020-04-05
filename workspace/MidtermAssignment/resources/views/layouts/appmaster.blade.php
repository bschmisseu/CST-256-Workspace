<html>
    <head>
    	<title>@yield('title')</title>
    	
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"></link>
    </head>
    <body>
    	@include('layouts.header')
    	<div align="center">
    		@yield('content')
    	</div>
    	@include('layouts.footer')
    </body>
</html>