<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Default - TCRC Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('documentation/css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ asset('documentation/css/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('documentation/css/app.min.css')}}">
    <link rel="stylesheet" href="{{ asset('documentation/css/mystyle.css')}}">

    <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
</head>
<body>

    <div id="app ">
        @include('documentation.layouts.sidebar')
        <div id="main">
            
            {{ $slot }}

            @include('documentation.layouts.footer')
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{asset ('documentation/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset ('documentation/js/mazer.js')}}"></script>
</body>

</html>
