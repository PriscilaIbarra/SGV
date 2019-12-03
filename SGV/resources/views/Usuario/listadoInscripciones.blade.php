@extends('layouts.app')

@section('content')
    @include('include.title&logo')
 <!--Inscripciones realizadas por el usuario -->
         <center>
             <div class="col-md-8 mt-4 ">
                    <div class="card">
                    <div class="card-header">
                        <strong>   
                            Inscripciones de   {{Auth::user()->apellido}}, {{Auth::user()->nombre }}
                        </strong>                     
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" scope="col">Id</th>
                                            <th class="sticky-top bg-light" scope="col">Fecha Generación</th>
                                            <th class="sticky-top bg-light" scope="col">Tipo Cargo</th>
                                            <th class="sticky-top bg-light" scope="col">Asignatura</th>
                                            <th class="sticky-top bg-light" scope="col">CV</th>
                                            <th class="sticky-top bg-light" scope="col">Estado</th>
                                            <th class="sticky-top bg-light" scope="col">Info</th>     
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if(!empty($inscripciones))
                                        	@foreach($inscripciones as $inscripcion)
	                                        <tr>
	                                            <td>{{$inscripcion->id}}</td>
                                                <td>{{date('d-m-Y',strtotime($inscripcion->created_at))}}</td>
                                                <td>{{$inscripcion->vacante->tipo_cargo->descripcion}}</td>
                                                <td>{{$inscripcion->vacante->asignatura->descripcion}}</td>
                                                <td>
                                                    <a href="{{route('visualizarCV',$inscripcion->id)}}" target="_blank">Ver</a>
                                                </td>
                                                <td>
                                                  @if(isset($inscripcion->vacante->orden->id))
                                                     <a href="{{route('visualizarConstancia',$inscripcion->vacante->orden->id)}}" target="_blank">Informe</a>
                                                  @else
                                                    <label>En desarrollo</label>
                                                  @endif
                                                </td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#_{{$inscripcion->id}}" href="#">
                                                             Ver más
                                                    </a>
                                                </td>	                                           
	                                        </tr>
	                                        @endforeach 
                                          @endif                                    
                                        </tbody>
                                </table>
                            </div>
                        </div>    
                    </div>
                    </div>
                    </div>        

                    </br> 
                     @if(session('success'))                    
                        <div align="center" class=" col-md-6 float-left mt-2 alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{session('success')}}</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        @elseif(session('error'))                    
                          <div align="center" class=" col-md-6 float-left mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                                  <strong>{{session('error')}}</strong>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                          </div>                      
                        @endif   
                </center>
                 @if(!empty($inscripciones))
                  @foreach($inscripciones as $inscripcion)  
                    <!-- Modal -->
                  <div class="modal fade" id="_{{$inscripcion->id}}" tabindex="-1" role="dialog" aria-labelledby="_{{$inscripcion->id}}" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                      <h5 class="modal-title" align="center" id="exampleModalLabel">
                                        <strong>Detalle de la vacante</strong>
                                      </h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                      </button>
                               </div>
                               <div class="modal-body">
                                  <div class="form-row">
                                    <div class="col mt-4 text-left">
                                      <label for="validationDefault01"><strong>Asignatura:</strong></label>
                                      <input disabled="true" type="text" class="form-control font-weight-bold text-dark" id="validationDefault01" placeholder="Asignatura" value="{{$inscripcion->vacante->asignatura->descripcion}}" required>
                                    </div>
                                   </div>
                                   <div class="form-row">
                                    <div class="col mt-4 text-left">
                                      <label for="validationDefault02" class="text-left"><strong>Tipo de Cargo:</strong></label>
                                      <input disabled="true" type="text" class="form-control font-weight-bold text-dark" id="validationDefault02" placeholder="Tipo de cargo" value="{{$inscripcion->vacante->tipo_cargo->descripcion}}" required>
                                    </div>
                                  </div>
                                <div class="form-row">
                                   <div class="col-md-6 mt-4 text-left">
                                    <label for="validationDefault03" class="text-left">Fecha de Apertura:</label>
                                    <input disabled="true" type="text" class="form-control" id="validationDefault03" placeholder="Fecha Limite" value="{{date('d-m-Y',strtotime($inscripcion->vacante->fecha_apertura))}}" required>
                                  </div>
                                  <div class="col-md-6 mt-4 text-left">
                                    <label for="validationDefault03" class="text-left">Fecha de Cierre:</label>
                                    <input disabled="true" type="text" class="form-control" id="validationDefault03" placeholder="Fecha Limite" value="{{date('d-m-Y',strtotime($inscripcion->vacante->fecha_cierre))}}" required>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="col mt-4 text-left">
                                    <label for="validationDefault04" class="text-left">Horario:</label>
                                    <input disabled="true" type="text" class="form-control" id="validationDefault04" placeholder="Horario" value="{{$inscripcion->vacante->horario}}" required>
                                  </div>
                                </div>    

                                <div class="card-header card mt-3 bg-light " >
                                  <label for="validationDefault01"><strong>Requisitos : </strong></label>
                                </div>
                               <div class="form-group mt-3">                        
                                <p class="text-left">
                                    {{$inscripcion->vacante->requisitos}}
                                </p>                
                              </div>
                            <div class="card-header card mt-3 bg-light ">
                              <label for="validationDefault01">
                                    <strong>Adicionales :</strong>
                              </label>                     
                            </div>
                            <div class="form-group mt-3">
                                <p class="text-left">                         
                                  {{$inscripcion->vacante->adicionales}}
                                </p>
                             </div>
                              <div class="card-header card mt-3 bg-light " >
                                <label for="validationDefault01">
                                  <strong>Presentación :</strong>
                                </label>                          
                              </div>
                              <div class="form-group mt-3">                          
                                <p class="text-left">
                                    {{$inscripcion->vacante->presentacion}}
                                </p> 
                              </div>
                               </div>                     
                               <div class="modal-footer">                
                                   <button type="button" class="btn btn-warning" >
                                      <a  href="{{route('imprimirVacante',$inscripcion->vacante->id)}}" target="_blank">Imprimir</a>
                                  </button> 
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                               </div>
                            </div>
                        </div>
                    </div>           
                 @endforeach
                  @endif                                      
                    <!-- -->          
                 <div class="mb-4">
                   
                 </div>
                                       
                                   
            @include('include.note')
@endsection