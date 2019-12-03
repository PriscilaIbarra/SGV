@extends('layouts.app')

@section('content')

 <center>
      <div class="col-md-10 mt-4">
                <div class="card">
                  <div class="card-header">
                        Ordenes de mérito
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" scope="col">Id Orden</th>
                                            <th class="sticky-top bg-light" scope="col">Id Vacante</th>
                                            <th class="sticky-top bg-light" scope="col">Asignatura</th>
                                            <th class="sticky-top bg-light" scope="col">Tipo de Cargo</th>
                                            <th class="sticky-top bg-light" scope="col">Info Vacante</th>   
                                            <th class="sticky-top bg-light" scope="col">Editar</th>  
                                            <th class="sticky-top bg-light" scope="col">Ver Constancia</th>  
                                        </tr>
                                        </thead>
                                        <tbody>                                          
                                        @foreach($vacantes as $vacante)    
                                        <tr>
                                            <td>{{$vacante->orden->id}}</td>
                                            <td>{{$vacante->id}}</td>                                        
                                            <td>{{$vacante->asignatura->descripcion}}</td>
                                            <td>{{$vacante->tipo_cargo->descripcion }}</td>
                                            <td scope="col">
                                                <button class="mt-1 col btn btn-outline-info" type="button"  data-toggle="modal" data-target="#_{{$vacante->id}}">
                                                              Ver más
                                                </button>                                
                                            </td>
                                            <td scope="col">
                                                  <a class="btn btn-outline-success" 
                                                  href="{{route('calificarOrdenMerito',$vacante->id)}}">Editar
                                                  </a>                                    
                                            </td>  
                                             <td scope="col">
                                                  <a class="btn btn-outline-primary" 
                                                  href="{{route('visualizarConstancia',$vacante->orden->id)}}" target="_blank">Ver Constancia
                                                  </a>                                    
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

           @foreach($vacantes as $vacante)  
            <!-- Modal info vacante-->
          <div class="modal fade" id="_{{$vacante->id}}" tabindex="-1" role="dialog" aria-labelledby="_{{$vacante->id}}" aria-hidden="true">
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
                              <label for="validationDefault01">Asignatura:</label>
                              <input disabled="true" type="text" class="form-control" id="validationDefault01" placeholder="Asignatura" value="{{$vacante->asignatura->descripcion}}" required>
                            </div>
                           </div>
                           <div class="form-row">
                            <div class="col mt-4 text-left">
                              <label for="validationDefault02" class="text-left">Tipo de Cargo:</label>
                              <input disabled="true" type="text" class="form-control" id="validationDefault02" placeholder="Tipo de cargo" value="{{$vacante->tipo_cargo->descripcion}}" required>
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
                       <div class="modal-footer">                
                            <button type="button" class="btn btn-warning" >
                                      <a  href="{{route('imprimirVacante',$vacante->id)}}" target="_blank">Imprimir</a>
                            </button>  
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                       </div>
                    </div>
                </div>
            </div>           
         @endforeach                                             

@endsection