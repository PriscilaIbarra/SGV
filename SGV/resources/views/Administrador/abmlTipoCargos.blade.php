@extends('layouts.app')

@section('content')
 <center>
    {{$us = "" }}
        <div class="col-md-8 mt-4">
                <div class="card">
                  <div class="card-header">
                        TipoCargos
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" scope="col">Id</th>
                                            <th class="sticky-top bg-light" scope="col">Nombre</th>
                                            <th colspan="2" class="sticky-top bg-light" scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($tiposCargo as $tipoCargo)    
                                        <tr>
                                            <th scope="row">{{$tipoCargo->id}}</th>
                                            <td>{{$tipoCargo->nombre}}</td>
                                            <td scope="col">
                                                <button type="button"  class="btn btn-outline-danger" data-toggle="modal" data-target="#_{{$tipoCargo->id}}">
                                                  Eliminar
                                                </button>                                        
                                            </td>
                                            <td scope="col">
                                                <a href="{{route('editarTipoCargo',$tipoCargo->id)}}" class="btn btn-outline-primary">
                                                   Editar
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
                    <a href="{{route('agregarTipoCargo')}}" class="float-right mt-4 btn btn-success ">       Agregar
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
                    @endif
                </div>        
        </center>         
         @foreach($tiposCargo as $tipoCargo)        
            <!-- Modal -->
             <div class="modal fade" id="_{{$tipoCargo->id}}" tabindex="-1" role="dialog" aria-labelledby="_{{$tipoCargo->id}}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar TipoCargo</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                       </div>
                       <div class="modal-body">
                             Desea eliminar al TipoCargo:<br>
                            <strong>Id: </strong>{{$tipoCargo->id}}<br>
                        
                            <strong>Nombre: </strong>{{$tipoCargo->nombre}}<br>
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