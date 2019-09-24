@extends('layouts.app')

@section('content')
		<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Registro TipoCargo') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('agregarTipoCargo') }}">
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