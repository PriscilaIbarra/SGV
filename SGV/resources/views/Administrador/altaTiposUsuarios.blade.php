@extends('layouts.app')

@section('content')
		<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Registro Tipos de Usuarios</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('agregarTiposUsuarios') }}">
                        @csrf

                   <div class="form-row">
                        <div class="col-md-6 mt-4 text-left">
                           <label for="nombre" >
                                  {{ __('Descripcion') }}
                           </label>
                           <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus placeholder="descripcion">
                                @error('descripcion')
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