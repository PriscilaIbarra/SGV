@extends('layouts.app')

@section('content')
  @include('include.title&logo')
<!--Lista de vacantes por materia -->
             <center>
                <div class="col-md-8 mt-4 ">
                    <div class="card">
                    <div class="card-header">
                        Vacantes {{$vacantes[0]->desc_asig}}
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
                                                    <td>{{$vacante->desc_tipo_cargo}}.</td>
                                                    <td class="d-none d-sm-table-cell">       
                                                        <p>
                                                          {{substr($vacante->requisitos,0,204)}}...
                                                        </p>                                                              
                                                    </td>
                                                    <td>
                                                      {{
                                                        date('d-m-Y',strtotime($vacante->fecha_cierre))
                                                      }}                                      
                                                    </td>
                                                    <td>
                                                       {{$vacante->horario}}
                                                    </td>
                                                    <td>
                                                          <a href="{{route('inscribirseVacante',$vacante->id)}}" class="col btn btn-outline-primary">
                                                                Inscribirse
                                                          </a>             

                                                          <button class="mt-1 col btn btn-outline-info"
                                                          data-toggle="modal" data-target="#_{{$vacante->id}}">
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
        @include('include.note')
              @foreach($vacantes as $vacante)
                       <!-- Modal -->
             <div class="modal fade" id="_{{$vacante->id}}" tabindex="-1" role="dialog" aria-labelledby="_{{$vacante->id}}" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLongTitle">
                                    <strong>Tipo de cargo:</strong> 
                                      {{$vacante->desc_tipo_cargo}}.
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
                                                                      <input disabled="true" type="text" class="form-control" id="validationDefault01" placeholder="Asignatura" value="{{$vacante->desc_asig}}" required>
                                                                </div>
                                                            </div>
                                                           <div class="form-row">
                                                            <div class="col mt-4 text-left">
                                                              <label for="validationDefault02" class="text-left">Tipo de Cargo:</label>
                                                              <input disabled="true" type="text" class="form-control" id="validationDefault02" placeholder="Tipo de cargo" value="{{$vacante->desc_tipo_cargo}}" required>
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
                                <button type="button" class="btn btn-warning" >Imprimir</button> 
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>     
                              </div>
                            </div>
                          </div>
                        </div>
                     <!-- -->

              @endforeach
               <center> 
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
                </center>
@endsection