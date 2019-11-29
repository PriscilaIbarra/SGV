@extends('layouts.app')

@section('content')

<center>
      <div class="col-md-10 mt-4">
                <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col">
                          <div class="text-center">
                            <img src="{{ asset('imagenes/logo.png') }}">
                            <h4>Universidad Tecnologica Nacional</h4>
                              <h5 style="margin-top:-9px;">Facultad Regional Rosario</h5>
                          </div>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col">

                        </div>
                     </div>
                     <div class="dropdown-divider" style="border-width:2px;border-color:grey;"></div>
                       <div class="row text-center">   
                              <div class="col">
                                <center>
                                  <h5 align="center" class="font-weight-bold mt-2">ORDEN DE MERITO</h5>
                                </center>
                              </div>
                      </div>
                    <div class="dropdown-divider" style="border-width:2px;border-color:grey;"></div>
                     <div class="row">
                        <div class="col-md-5 float-left">
                          <div class="text-left">
                              <h6>
                                  <strong>Vacante:</strong>
                              </h6>                            
                              <label>Id: {{$vacante->id}}</label>
                              <br>
                              <label>Asignatura: {{$vacante->asignatura->descripcion}}</label><br>
                              <label>Tipo de cargo: {{$vacante->tipo_cargo->descripcion}}</label>            
                          </div>
                        </div>
                        <div class="col-md-4">
                               <center>
                                 <div class="text-left ml-5">
                                    <h6>
                                       <strong>Orden:</strong>
                                    </h6>
                                    <label>Id: {{$vacante->id_orden_merito}}</label>
                                    <br>
                                    <label>Fecha creación:</label><br>
                                    <label>Fecha última actualización:</label><br>
                                    <label>Fecha Generación Constacia:</label>   
                                 </div>
                              </center>                                           
                        </div>
                        <div class="col text-left">
                            <h6><strong>Jefe de Cátedra:</strong></h6>                                 
                            <label>Apellido: {{Auth::user()->apellido}}</label>
                            <br>
                            <label>Nombre: {{Auth::user()->nombre}}</label>                             
                        </div>                        

                     </div>

                     </div>
                  
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" scope="col">Orden</th>
                                            <th class="sticky-top bg-light" scope="col">Apellido y Nombre</th>
                                            <th class="sticky-top bg-light" scope="col">DNI</th>
                                            <th class="sticky-top bg-light" scope="col">Puntaje</th>
                                        </tr>
                                        </thead>
                                        <tbody>                                                               @php
                                          $c=0;
                                        @endphp              
                                        @foreach($vacante->inscripciones as $inscripcion)    
                                        <tr>
                                            <td>{{++$c}}</td>
                                            <td>
                                               {{$inscripcion->user->apellido}} , {{$inscripcion->user->nombre}}
                                            </td>   
                                            <td>
                                               {{$inscripcion->user->dni}}
                                            </td>
                                            <td>
                                               {{$inscripcion->calificacion}}
                                            </td>                                                    
                                        </tr>
                                        @endforeach
                                        </tbody>
                                      
                                        
                                </table>
                                  
                            </div>
                        </div>    
                    </div> 

                    </div>


                    @if(session('success'))
                    <div class=" col-md-6 float-left mt-2 alert alert-success alert-dismissible fade show" role="alert">
                          <strong>{{session('success')}}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    @elseif(session('error'))
                    <div class=" col-md-6 float-left mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>{{session('error')}}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    @endif
                </div>        
        </center>  
 @endsection