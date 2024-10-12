<x-guest-layout>
<body class="hold-transition login-page" style="background: #c0e6ed;">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="login-card-header text-center p-3">
          <a href="{{url('')}}" class="h1">གློག་འཕྲུལ་ཡིག་ཚགས།</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg text-lg">ཁྱེད་རང་གི་ལས་ཀ་འགོ་འཛུགས་ཆེད་ནང་འཛུལ་བྱོས།</p>          
          <x-jet-validation-errors class="text-danger" />
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="{{ __('སྤྱོད་མིང་ངོ་རྟགས།') }}" name="email" value = "{{$request->old('email')}}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="{{ __('གསང་ཚིག།') }}" name="password" >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block text-md">{{ __('ནང་འཛུལ་བྱོས།') }}</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
    
          <p class="mb-1">
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">{{ __('གསང་ཚིག་དྲན་པ་བརྗེད་ན་འདིར་སྣོན།') }}</a>
            @endif
          </p>          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->
    </x-guest-layout>