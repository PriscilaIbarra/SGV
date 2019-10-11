@extends('layouts.app')

@section('content')
<center>
     <div class="col-md-3 login">
                <form method="POST" action="{{ route('login') }}" class="form-signin">
                      <h1 class="h3 mb-3 font-weight-normal">{{ __('Iniciar Sesion') }}</h1>
                      @csrf
                       <label for="inputEmail" class="sr-only">
                            {{ __('E-Mail') }}
                       </label>
                           <input type="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                       <label for="inputPassword" class="sr-only">
                             {{ __('Contraseña') }}
                       </label>
                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                @error('contraseña')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                           {{ __('Iniciar Sesion') }}
                        </button>
                          <div class="form-check float-left">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                        </div>
                        <br>
                 <div class="row">
                     <div class="col">
                        <sub class="float-left mt-1">
                             @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Olvidé mi contraseña?') }}
                                </a>
                             @endif
                        </sub>
                     </div>
                    <div class="col text-right">
                            <sub class="float-right mt-1">
                                <a class="text-right" href="{{ route('register') }}">
                                  Registrarse
                                </a>
                            </sub>
                    </div>
                </div>  
          </form>
          @if(session('error'))
           <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
           </div>
          @endif
     </div>  
 </center>
@endsection
