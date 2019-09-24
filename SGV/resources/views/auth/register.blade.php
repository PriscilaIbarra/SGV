@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Registro Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                   <div class="form-row">
                        <div class="col-md-6 mt-4 text-left">
                           <label for="nombre" >
                                  {{ __('Nombre') }}
                           </label>
                           <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus placeholder="Nombre">
                                @error('nombre')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                                @enderror                           
                        </div>
                        <div class="col-md-6 mt-4 text-left">
                             <label for="apellido">
                                 {{ __('Apellido') }}
                             </label>
                              <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus placeholder="Apellido">
                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                             
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col text-left mt-2">
                           <label for="validationDefault03">{{ __('Email') }}</label>
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                        </div>
                     </div>
                     <div class="form-row">
                         <div class="col-md-6 mt-4 text-left">
                            <label for="validationDefault01">
                                {{ __('Contraseña') }}
                            </label>
                            <input id="contraseña" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required autocomplete="new-password" placeholder="Contraseña">
                                @error('contraseña')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                              
                         </div>
                         <div class="col-md-6 mt-4 text-left">
                           <label for="validationDefault02">
                                {{ __('Confirmar contraseña') }}
                           </label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar">        
                         </div>
                        
                     </div>
                       <button type="submit" class="btn btn-primary mt-4 float-right">
                                {{ __('Confirmar Registro') }}
                       </button>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
