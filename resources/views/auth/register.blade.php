<x-guest-layout>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{url('')}}" class="h1"><b>CTA</b> e-filing</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg text-lg">{{ __('ཁ་བྱང་གསར་པ་འདིར་བཟོ་རོགས།') }}</p>
      <x-jet-validation-errors class="mb-4"  class="text-danger"/>
      <form method="POST" action="{{ route('register') }}">
            @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="{{ __('མིང་།') }}" name="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="{{ __('སྤྱོད་མིང་ངོ་རྟགས།') }}" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="{{ __('གསང་ཚིག') }}" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="{{ __('གསང་ཚིག་ངེས་བརྟན་བཟོ།') }}" name="password_confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="flex flex-col justify-around h-full">
          @livewire('register-dropdowns')
        </div>
          
          <!-- /.col -->
          <div class="social-auth-links text-center">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
          </div>
          <!-- /.col -->
        
      </form>

      <a href="{{ route('login') }}" class="text-center">{{ __('Already have an account?') }}</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
@livewireScripts
<body>
</x-guest-layout>