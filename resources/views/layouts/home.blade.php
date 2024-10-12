<!-- This layout is for home page and documentations -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>e-filing</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/mystyle.css')}}">

  
</head>

<body class="hold-transition layout-top-nav">
<div class="wrapper" style="font-family:Ouchan2 !important">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="background-color: #447c9d;">
    <div class="container">
      <a href="{{url('')}}" class="navbar-brand">
        <img src="{{asset('img/CTALogo.png')}}" alt="e-filing Logo" class="brand-image-welcome-logo" style="opacity: 0.9">
        <span class="brand-welcome-text">གློག་འཕྲུལ་ཡིག་ཚགས།</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#" class="nav-link text-lg ">མདུན་ངོས།</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-lg ">གསལ་བསྒྲགས།</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-lg ">བེད་སྤྱོད་ལམ་སྟོན།</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{ url('documentation/welcome')}}" class="dropdown-item">བཀོལ་སྤྱོད་ལམ་སྟོན།</a></li>

              <li><a href="{{ url('documentation/faq')}}" class="dropdown-item">བསྐྱར་འདྲི་ཡང་འདྲིའི་དྲི་བ།</a></li>
            </ul>
          </li>
        </ul>

        {{-- <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar text-md" type="search" placeholder="འཚོལ།" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div> --}}

      <!-- Right navbar links-->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">      
        @if (Route::has('login'))
            @auth                     
            <li>
                <a href="{{ url('/dashboard') }}" class="btn login-button btn-lg">མདུན་འཆར།</a>
            </li>
            @else
            <li>
            <a href="{{ route('login') }}" class="btn login-button btn-lg">ནང་འཛུལ་བྱོས།</a>
            </li>           
            @endauth
        @endif
        
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  {{ $slot }}
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/js/adminlte.min.js')}}"></script>
</body>
</html>
