@extends('layouts.app')

@section('content')
 <center>
       <div class="col-md-8 mt-4">
                <div class="card">
                  <div class="card-header">
                        Tipos Cargos
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" style="z-index: 1;"  scope="col">Id</th>
                                            <th class="sticky-top bg-light" style="z-index: 1;"  scope="col">Descripcion</th>
                                            <th colspan="2" class="sticky-top bg-light" style="z-index: 1;"  scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($tipos as $tipoCargo)    
                                        <tr>
                                            <th scope="row">{{$tipoCargo->id}}</th>
                                            <td>{{$tipoCargo->descripcion}}</td>
                                            <td scope="col">
                                                <center>
                                                    <button type="button"  class="btn btn-outline-danger" data-toggle="modal" data-target="#_{{$tipoCargo->id}}">
                                                    Eliminar
                                                    </button> 
                                                    <a href="{{route('editarTipoCargo',$tipoCargo->id)}}" class="btn btn-outline-primary">
                                                    Editar
                                                    </a>
                                                </center>                                      
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
                    </div>
                    <a href="{{route('agregarTiposCargo')}}" class="float-right mt-4 btn btn-success ">       Agregar
                    </a>
                </div>        
        </center>         
         @foreach($tipos as $tipoCargo)        
            <!-- Modal -->
             <div class="modal fade" id="_{{$tipoCargo->id}}" tabindex="-1" role="dialog" aria-labelledby="_{{$tipoCargo->id}}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Tipo de Cargo</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                       </div>
                       <div class="modal-body">
                             Desea eliminar al Tipo de Cargo:<br>
                            <strong>Id: </strong>{{$tipoCargo->id}}<br>
                        
                            <strong>Descripción: </strong>{{$tipoCargo->descripcion}}<br>
                            <br>
                          <strong>
                              <span class="text-danger">La acción no podrá revertirse.</span>
                          </strong>
                       </div>
                       <div class="modal-footer">
                           <a href="{{route('deleteTipoCargo',$tipoCargo->id)}}" class="btn btn-primary">Aceptar</a>   
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                       </div>
                    </div>
                </div>
            </div>
            <!-- -->  
         @endforeach                                                  
@endsection