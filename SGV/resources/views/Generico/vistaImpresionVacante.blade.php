<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/png" href="{{ asset('imagenes/logo.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'newname') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">


    <!-- Bootstrap cdn new version-->    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body onload="imprimir()">
	<center>
	<div class="container col-md-10 mt-4 mb-4">
	  <div class="card">
                       	<div class="card-header">
                                                      <h5 class="card-title" align="center">
                                                        <strong>Vacante</strong>
                                                      </h5>                                                    
                                                    </div>
                                               <div class="card-body">
                                                          <div class="form-row">
                                                                <div class="col mt-4 text-left">
                                                                    <label for="validationDefault01">Asignatura:</label>
                                                                      <input disabled="true" type="text" class="form-control" id="validationDefault01" placeholder="Asignatura" value="{{$vacante->asignatura->descripcion}}" required>
                                                                </div>
                                                            </div>
                                                           <div class="form-row">
                                                            <div class="col mt-4 text-left">
                                                              <label for="validationDefault02" class="text-left">Tipo de Cargo:</label>
                                                              <input disabled="true" type="text" class="form-control" id="validationDefault02" placeholder="Tipo de cargo" value="{{$vacante->tipo_cargo->desc}}" required>
                                                            </div>
                                                          </div>
                                                          <div class="form-row">
                                                             <div class="col-md-6 mt-4 text-left">
                                                              <label for="validationDefault03" class="text-left">Fecha de Apertura:</label>
                                                              <input disabled="true" type="text" class="form-control" id="validationDefault03" placeholder="Fecha Limite" value="{{date('d-m-Y',strtotime($vacante->fecha_apertura))}}" required>
                                                            </div>
                                                            <div class="col-md-6 mt-4 text-left">
                                                              <label for="validationDefault03" class="text-left">Fecha de Cierre:</label>
                                                              <input disabled="true" type="text" class="form-control" id="validationDefault03" placeholder="Fecha Limite" value="{{date('d-m-Y',strtotime($vacante->fecha_cierre))}}" required>
                                                            </div>
                                                          </div>
                                                          <div class="form-row">
                                                            <div class="col mt-4 text-left">
                                                              <label for="validationDefault04" class="text-left">Horario:</label>
                                                              <input disabled="true" type="text" class="form-control" id="validationDefault04" placeholder="Horario" value="{{$vacante->horario}}" required>
                                                            </div>
                                                          </div>  
                                                          <div class="card-header card mt-3 bg-light " >
                                                            <label for="validationDefault01"><strong>Requisitos : </strong></label>
                                                          </div>
                                                         <div class="form-group mt-3">                        
                                                          <p class="text-left">
                                                              {{$vacante->requisitos}}
                                                          </p>                
                                                        </div>
                                                        <div class="card-header card mt-3 bg-light ">
                                                          <label for="validationDefault01">
                                                                <strong>Adicionales :</strong>
                                                          </label>                     
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <p class="text-left">                         
                                                              {{$vacante->adicionales}}
                                                            </p>
                                                         </div>
                                                        <div class="card-header card mt-3 bg-light " >
                                                          <label for="validationDefault01">
                                                            <strong>Presentación :</strong>
                                                          </label>                          
                                                        </div>
                                                        <div class="form-group mt-3">                          
                                                          <p class="text-left">
                                                              {{$vacante->presentacion}}
                                                          </p> 
                                                        </div>
                                               </div>                                    
                                           </div>     

      </div>    
      </center>                                      

      <script type="text/javascript">
      	function imprimir()
      	{
      		window.print();
      	}
      </script>
</body>

</html>


