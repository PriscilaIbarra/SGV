@extends('layouts.app')

@section('content')
 <center>
      <div class="col-md-10 mt-4">
                <div class="card">
                  <div class="card-header">
                        Vacantes
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" scope="col">Id</th>
                                            <th class="sticky-top bg-light" scope="col">Asignatura</th>
                                            <th class="sticky-top bg-light" scope="col">Tipo de Cargo</th>
                                            <th class="sticky-top bg-light" scope="col">Fecha Creación</th>
                                            <th class="sticky-top bg-light" scope="col">Fecha Apertura</th>
                                            <th class="sticky-top bg-light" scope="col">Fecha Cierre</th>
                                            <th class="sticky-top bg-light" scope="col">
                                            Estado   
                                            </th>
                                            <th class="sticky-top bg-light" scope="col">
                                            </th>
                                            <th class="sticky-top bg-light" scope="col">
                                            </th>
                                            <th class="sticky-top bg-light" scope="col">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>                                          
                                        @foreach($vacantes as $vacante)    
                                        <tr>
                                            <th scope="row">{{$vacante->id}}</th>
                                            <td>{{$vacante->asignatura->descripcion}}</td>
                                            <td>{{$vacante->tipo_cargo->descripcion }}</td>
                                            <td>{{$vacante->created_at->format('d-m-Y H:m:s')}}</td>
                                            <td>{{date('d-m-Y',strtotime($vacante->fecha_apertura))}}</td>
                                            <td>{{date('d-m-Y',strtotime($vacante->fecha_cierre))}}</td>
                                            <td>{{ucfirst($vacante->estado)}}</td>
                                             <td scope="col">
                                                <a href="{{route('editarVacante',$vacante->id)}}" class="btn btn-outline-success">
                                                   Editar
                                                </a>                                      
                                            </td>
                                            <td scope="col">
                                                <a href="{{route('deleteVacante',$vacante->id)}}" class="btn btn-outline-danger">
                                                   Eliminar
                                                </a>                                      
                                            </td>
                                            <td scope="col">
                                               <button type="button"  class="btn btn-outline-info" data-toggle="modal" data-target="#_{{$vacante->id}}">
                                                  Ver 
                                                </button>                                     
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>    
                    </div>                         
                    </div>
                    <a href="{{route('altaVacante')}}" class="float-right mt-4 btn btn-success ">Agregar
                    </a>
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
                    @elseif(session('warning'))
                    <div class=" col-md-6 float-left mt-2 alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>{{session('warning')}}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    @endif
                </div>        
        </center>         
        @foreach($vacantes as $vacante)  
            <!-- Modal -->
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