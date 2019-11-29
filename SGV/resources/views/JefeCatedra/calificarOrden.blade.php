@extends('layouts.app')

@section('content')
<center>
      <div class="col-md-10 mt-4">
                <div class="card">
                  <div class="card-header">
                     Orden de merito para <strong>{{$vacante->asignatura->descripcion}}</strong> para el cargo <strong>{{$vacante->tipo_cargo->descripcion}}</strong>
                    </div>
                    <form method="post" action="{{route('actualizarCalificaciones')}}">
                      @csrf
                      <input type="hidden" name="idVacante" value="{{$vacante->id}}">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" scope="col">Apellido y nombre</th>
                                            <th class="sticky-top bg-light" scope="col">CV</th>         
                                            <th class="sticky-top bg-light" scope="col">Calificación</th>                                            
                                        </tr>
                                        </thead>
                                        <tbody>                                                                 
                                        @foreach($vacante->inscripciones as $inscripcion)    
                                        <tr>
                                            <td>{{$inscripcion->user->apellido}} , {{$inscripcion->user->nombre}}</td>
                                            <td>
                                                <a href="{{route('visualizarCV',$inscripcion->id)}}" target="_blank">Ver</a>
                                            </td>
                                            <td>
                                              <input type="number" class="form-control" name="{{'inscripciones'.'['.$inscripcion->id.']'}}" value="{{$inscripcion->calificacion}}">
                                            </td>                                                                 
                                        </tr>
                                        @endforeach
                                        </tbody>
                                      
                                        
                                </table>
                                                                        
                            </div>
                        </div>    
                      </div>
                         <button type="submit" name="opcion" value="Publicar" class="btn btn-primary text-white">Publicar</button>
                         <button type="submit" name="opcion" value="Guardar" class="btn btn-primary text-white" >Guardar</button>
                    </form>     
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