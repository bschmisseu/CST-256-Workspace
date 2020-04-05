<html>
    <head>
    	<title>@yield('title')</title>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"></link>
    	<link rel="stylesheet" href="resources/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="resources/assets/css/Navigation-with-Button.css">
        <link rel="stylesheet" href="resources/assets/css/styles.css">
    </head>
    <body>
    	@include('layouts.headerBootstrap')
    	<div align="center">
    		@yield('content')
    	</div>
    	@include('layouts.footerBootstrap')
    </body>
</html>