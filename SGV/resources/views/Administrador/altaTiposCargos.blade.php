@extends('layouts.app')

@section('content')
		<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Registro Tipos de Cargo</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('altaTiposCargo') }}">
                        @csrf
                        <div class="form-row">
                             <div class="col-md-6 col-sm">
                               <label for="nombre">
                                      {{ __('Descripción') }}:
                               </label>
                               <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus placeholder="Descripcion">
                                    @error('descripcion')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror     
                               </div>
                               <div class="col-md-3 col-sm  mt-2 ">                                             
                                 <button type="submit" class=" btn btn-primary mt-md-4 float-right">
                                          {{ __('Confirmar Registro') }}
                                 </button> 
                               </div>  
                         </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection