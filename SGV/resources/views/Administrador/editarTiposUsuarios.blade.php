@extends('layouts.app')

@section('content')
		<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Editar Tipos de Usuarios</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('updateTiposUsuarios') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mt-4 text-left">
                               <label for="nombre" >
                                      {{ __('Descripción') }}:
                               </label>
                               <input type="hidden" name="id" value="{{$tip->id}}">
                               <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{$tip->descripcion}}" required autocomplete="descripcion" autofocus placeholder="descripcion">
                                    @error('descripcion')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror                           
                            </div>
                           <div class="col-md-4 mt-md-5"> 
                             <button type="submit" class="btn btn-primary mt-md-2 mt-1 mr-md-4 float-right">
                                      {{ __('Confirmar Modificación') }}
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