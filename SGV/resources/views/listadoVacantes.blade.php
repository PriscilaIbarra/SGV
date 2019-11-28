@extends('welcome')

@section('content')
  @include('include.title&logo')
      <!--Lista de vacantes por materia -->
             <center>
                <div class="col-md-8 mt-4 ">
                    <div class="card">
                    <div class="card-header">
                        Vacantes {{$vacantes[0]->asignatura->descripcion}}
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">                                  
                                        <table class="table table-hover">
                                            <thead>
                                                        <th class="sticky-top bg-light" scope="col">Tipo Cargo</th>
                                                        <th class="sticky-top bg-light  d-none d-sm-table-cell" scope="col">Requisitos</th>
                                                        <th class="sticky-top bg-light" scope="col">fechaCierre</th>
                                                        <th class="sticky-top bg-light" scope="col">Horario</th>
                                                        <th colspan="2" class="sticky-top bg-light" scope="col"></th>
                                            </thead>
                                            
                                            <tbody>
                                            	@foreach($vacantes as $vacante)
                                                <tr>
                                                    <td>{{$vacante->tipo_cargo->descripcion}}</td>
                                                    <td class="d-none d-sm-table-cell">       
                                                        <p>
                                                          {{substr($vacante->requisitos,0,204)}}...
                                                        </p>                                                              
                                                    </td>
                                                    <td>{{ date('d-m-Y',strtotime($vacante->fecha_cierre))}}</td>
                                                    <td>
                                                        {{$vacante->horario}}
                                                    </td>
                                                    <td>
                                                          <a href="{{route('login')}}" class="col btn btn-outline-primary">
                                                                Inscribirse
                                                          </a>                             

                                                          <button class="mt-1 col btn btn-outline-info" type="button"  data-toggle="modal" data-target="#_{{$vacante->id}}">
                                                              Ver más
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
                    </div>        
                </center>            

            <!-- -->
           	  @foreach($vacantes as $vacante)
             <!-- Modal -->
             <div class="modal fade" id="_{{$vacante->id}}" tabindex="-1" role="dialog" aria-labelledby="_{{$vacante->id}}" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLongTitle">
                                    <strong>Tipo de cargo:</strong> 
                                      {{$vacante->tipo_cargo->descripcion}}.
                                </h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">                                        
                                        <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" align="center">
                                                        <strong>Detalle de la vacante</strong>
                                                      </h5>                                                    
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
                     <!-- -->
               @endforeach      
  @include('include.note')
@endsection