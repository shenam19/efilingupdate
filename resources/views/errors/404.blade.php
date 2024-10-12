<!DOCTYPE html>
<html lang="en">
     <head>
     <link rel="stylesheet" type="text/css" href="{{ asset('css/404.css')}}"/>
     <link rel="stylesheet" type="text/css" id="bootstrap-css" href="{{ asset('css/404s.css')}}"/> 
    </head>   
 <body>
    <div class="d-flex flex-column justify-content-center align-items-center" id="main">
		<div class="d-flex justify-content-center align-items-center">
			<h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">404</h1>
			<div class="inline-block align-middle">
				<h2 class="font-weight-normal lead" id="desc">The page you requested was not found.</h2>
			</div>
		</div>
		<div class="inline-block">
			<a href="{{route('dashboard')}}" class="btn btn-link text-info">Back To Home</a>
		</div>
    </div>
  </body>
</html>