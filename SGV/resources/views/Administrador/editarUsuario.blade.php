@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Registro Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('updateUsuario') }}">
                        @csrf

                   <div class="form-row">
                        <div class="col-md-6 mt-4 text-left">
                           <label for="nombre" >
                                  {{ __('Nombre') }}
                           </label>
                           <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $us->nombre }}" required autocomplete="nombre" autofocus placeholder="Nombre">
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
                              <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ $us->apellido}}" required autocomplete="apellido" autofocus placeholder="Apellido">
                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                             
                        </div>
                    </div>    
                    <div class="form-row">
                        <div class="col-md-12 mt-4 text-left">
                           <label for="nombre" >
                                  {{ __('Telefono') }}
                           </label>
                           <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $us->telefono }}" required autocomplete="telefono" autofocus placeholder="Telefono">
                                @error('telefono')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                                @enderror                           
                        </div>
                    </div>                      
                    <input type="hidden" name="id" value="{{$us->id}}">
                    <div class="form-row">
                        <div class="col text-left mt-2">
                           <label for="validationDefault03">{{ __('Email') }}</label>
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $us->email}}" required placeholder="Email" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                        </div>
                     </div>
                  <div class="form-row">
                        <div class="col text-left mt-2">
                           <label for="validationDefault03">{{ __('Tipo Usuario') }}</label>
                             <select id="id_tipo_usuario"  name="id_tipo_usuario" class="form-control" placeholder="Usuario" required>
                             	@foreach($tiposUsuarios as $tipoUsuario)
                                  @if($tipoUsuario->id == $us->id_tipo_usuario)
                                  <option selected value="{{$tipoUsuario->id}}">{{$tipoUsuario->descripcion}}</option>
                                  @else
                                  <option value="{{$tipoUsuario->id}}">{{$tipoUsuario->descripcion}}</option>
                                  @endif                             	
                             	@endforeach
                             </select>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                        </div>
                     </div>
                       <button type="submit" class="btn btn-primary mt-4 float-right">
                                Guardar
                       </button>   
                    </form>
                </div>
            </div>
        </div>
        @if(session('error'))
            <div class=" col-md-6 float-left mt-2 alert alert-danger alert-dismissible fade show" role="alert">
               <strong>{{session('error')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
            </div>
        @endif
    </div>
</div>
@endsection