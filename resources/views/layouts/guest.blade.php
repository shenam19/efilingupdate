<!-- This layout is for login page -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>e-filing</title>                

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}">
        
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">

        <!--  -->
        <link rel="stylesheet" href="{{ asset('css/mystyle.css')}}">

        @livewireStyles
        <style>
            .register-box{
                width: 500px
            }
            .login-box{
                width: 400px
            }
        </style>
    </head>
        <style>
            body{
                font-family:Ouchan2;
            }
        </style>
        
        {{ $slot }}
            
        <!-- jQuery -->
        <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('js/adminlte.min.js')}}"></script>


</html>

