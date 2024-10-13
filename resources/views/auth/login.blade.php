<x-home-layout>
    <div class="login-page">
        <div class="banner">
            <div class="message">
                <img src="{{ asset('img/cta_logo_red.png') }}" class="logo">
                <h1 class="welcoming">བོད་མིའི་སྒྲིག་འཛུགས་ཀྱི་གློག་འཕྲུལ་ཡིག་ཚགས་ལ་ཕེབས་པར་དགའ་བསུ་ཞུ།</h1>
            </div>
        </div>

        <div class="login">
            <div class="login-card">
                <div>
                    <x-jet-validation-errors class="text-danger" />
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login-field">
                            <input type="email" class="e-input-control" placeholder="{{ __('སྤྱོད་མིང་ངོ་རྟགས།') }}"
                                name="email" value="{{old('email')}}">
                        </div>
                        <div class="login-field">
                            <input type="password" class="e-input-control" placeholder="{{ __('གསང་ཚིག།') }}"
                                name="password">
                        </div>
                        <div class="login-field">
                            <div>
                                <div class="icheck-primary">
                                </div>
                            </div>
                            <!-- /.col -->
                            <div>
                                <button type="submit" class="e-input-control">{{ __('ནང་འཛུལ་བྱོས།')}}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('གསང་ཚིག་དྲན་པ་བརྗེད་ན་འདིར་སྣོན།') }}</a>
                        @endif
                    </p>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="footer">
                <ul>
                    <li><a href="{{ url('documentation/welcome') }}">བཀོལ་སྤྱོད་ལམ་སྟོན།</a></li>
                    <li><a href="{{ url('documentation/faq') }}">བསྐྱར་འདྲི་ཡང་འདྲིའི་དྲི་བ།</a></li>
                </ul>

                <p class="claim">v1.0 | Built & maintained by TCRC 👩🏻‍💻</p>
            </div>
        </div>
    </div>
</x-home-layout>
