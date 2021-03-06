@extends('layouts.app')

@section('content')

<center>
      <div class="col-md-10 mt-4">
                <div class="card">
                  <div class="card-header">
                     Orden de mérito de <strong>{{$vacante->asignatura->descripcion}}</strong> para el cargo <strong>{{$vacante->tipo_cargo->descripcion}}</strong>
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
                                            <th class="sticky-top bg-light" style="z-index: 1;"  scope="col">Apellido y nombre</th>
                                            <th class="sticky-top bg-light" style="z-index: 1;"  scope="col">CV</th>         
                                            <th class="sticky-top bg-light" style="z-index: 1;"  scope="col">Calificación</th>                                            
                                        </tr>
                                        </thead>
                                        <tbody>                                                                 
                                        @foreach($inscripciones as $inscripcion)    
                                        <tr>
                                            <td>{{$inscripcion->user->apellido}} , {{$inscripcion->user->nombre}}</td>
                                            <td>
                                                <a href="{{route('visualizarCV',$inscripcion->id)}}" target="_blank">Ver</a>
                                            </td>
                                            <td>
                                             <input type="number" required step="0.01"  min="0" max="10" id="inscripciones"
                                              class="form-control @error('inscripciones') is-invalid @enderror" 
                                              name="{{'inscripciones'.'['.$inscripcion->id.']'}}" value="{{$inscripcion->calificacion}}">
                                               @error('{{inscripciones}}')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                               @enderror     
                                            </td>                                                                 
                                        </tr>
                                        @endforeach
                                        </tbody>
                                      
                                        
                                </table>
                                                                        
                            </div>
                        </div>
                        @if(session('success'))                    
                                    <div align="center" class=" col float-left mt-4 alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>{{session('success')}}</strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                                    @elseif(session('error'))                    
                                      <div align="center" class=" col float-left mt-4 alert alert-danger alert-dismissible fade show" role="alert">
                                              <strong>{{session('error')}}</strong>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                      </div>                      
                           @endif    
                      </div>
                         <button type="submit" name="opcion" value="Publicar" class="btn btn-success text-white mb-2">Publicar</button>
                         <button type="submit" name="opcion" value="Guardar" class="btn btn-primary text-white mb-2" >Guardar</button>
                    </form>     
                    </div>
                    
                </div>        
        </center>  
 @endsection