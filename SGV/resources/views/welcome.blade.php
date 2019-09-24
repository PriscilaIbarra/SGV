@extends('layouts.app')

@section('content')
<center>
  <h5 class=" col-md-6 text-uppercase font-weight-bold mt-4">SISTEMA DE GESTIÓN DE VACANTES (SGV)</h5>
        <img src="{{ asset('imagenes/logo.png') }}">
      @include('listadoVacantes')
      
      <p class="text-center ml-4 mt-4" >
                        Nota: <strong>La asignación de cargos será efectuada en función del orden de mérito establecido y respetando las ordenanzas vigentes 1182 y 604.</strong>
     </p>     
</center>     
@endsection