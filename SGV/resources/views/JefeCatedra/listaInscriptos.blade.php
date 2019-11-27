@extends('layouts.app')

@section('content')

 <center>
      <div class="col-md-10 mt-4">
                <div class="card">
                  <div class="card-header">
                     Inscriptos a <strong>{{$vacante->asignatura->descripcion}}</strong> para <strong>{{$vacante->tipo_cargo->descripcion}}</strong>
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" scope="col">Apellido y nombre</th>
                                            <th class="sticky-top bg-light" scope="col">CV</th>                                         
                                        </tr>
                                        </thead>
                                        <tbody>                                          
                                        @foreach($inscripciones as $inscripcion)    
                                        <tr>
                                            <td>{{$inscripcion->user->apellido}},{{$inscripcion->user->nombre}}</td>
                                            <td>
                                                <a href="{{route('visualizarCV',$inscripcion->id)}}" target="_blank">Ver</a>
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