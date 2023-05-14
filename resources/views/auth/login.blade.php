@extends('layouts.auth_app')

@section('content')
<section>
    <div class="page-header min-vh-100">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
            <div class="card card-plain">
              <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Sign In</h4>
                <p class="mb-0">Enter your email and password to sign in</p>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-check form-switch">
                 
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                    
                    <label class="form-check-label" for="rememberMe">
                        {{ __('Remember Me') }}
                    </label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0"> {{ __('Login') }}</button>
                  </div>
                </form>
              </div>
              {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                 @endif
              </div> --}}
            </div>
          </div>
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
              <img src="{{ asset('img/shapes/pattern-lines.svg')}}" alt="pattern-lines" class="position-absolute opacity-4 start-0">
              <div class="position-relative">
                <img class="max-width-500 w-100 position-relative z-index-2" src="{{ asset('img/illustrations/bloom-skin-clinic-logo.png')}}" alt="chat-img">
              </div>
              <h4 class="mt-5 text-white font-weight-bolder">"Bloom Skin Care: Enhance Your Natural Beauty and Nourish Your Skin"</h4>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection
