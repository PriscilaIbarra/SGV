@extends('layouts.app')

@section('content')
		<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Editar Tipos de Cargo</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('updateTiposCargo') }}">
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
                        <div class="col-md mt-2  col-sm">
                           <button type="submit" class="btn btn-primary mt-md-5 float-right">
                                    {{ __('Confirmar Modificacion') }}
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