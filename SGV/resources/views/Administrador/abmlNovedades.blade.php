@extends('layouts.app')

@section('content')
 <center>
     <div class="col-md-8 mt-4">
                <div class="card">
                  <div class="card-header">
                        Novedades
                    </div>                   
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" scope="col">Id</th>
                                            <th class="sticky-top bg-light" scope="col">Descripcion</th>
                                            <th colspan="2" class="sticky-top bg-light" scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($novedades as $novedad)    
                                        <tr>
                                            <th scope="row">{{$novedad->id}}</th>
                                            <td>{{$novedad->descripcion}}</td>
                                            <td scope="col">
                                              @if(strcasecmp($novedad->estado,"inactivo")==0)
                                                <button type="button"  class="btn btn-outline-success" data-toggle="modal" data-target="#_{{$novedad->id}}">
                                                  Habilitar  &nbsp;
                                                </button>
                                              @else
                                               <button type="button"  class="btn btn-outline-danger" data-toggle="modal" data-target="#_{{$novedad->id}}">
                                                  Inhabilitar 
                                                </button>
                                              @endif                                          
                                            </td>
                                            <td scope="col">
                                                <a href="{{route('editarNovedad',$novedad->id)}}" class="btn btn-outline-primary">
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
                    <a href="{{route('agregarNovedades')}}" class="float-right mt-4 btn btn-success ">       Agregar
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
         @foreach($novedades as $novedad)        
            <!-- Modal -->
             <div class="modal fade" id="_{{$novedad->id}}" tabindex="-1" role="dialog" aria-labelledby="_{{$novedad->id}}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Novedad</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                       </div>
                       @if ($novedad->estado=="inactivo")
                       <div class="modal-body">
                             Desea habilitar la novedad:<br>
                            <strong>Id: </strong>{{$novedad->id}}<br>
                            <strong>Descripcion: </strong>{{$novedad->descripcion}}<br>   
                       </div>
                       @else
                       <div class="modal-body">
                             Desea Inhabilitar la novedad:<br>
                            <strong>Id: </strong>{{$novedad->id}}<br>
                            <strong>Descripcion: </strong>{{$novedad->descripcion}}<br>   
                       </div>
                       @endif
                       <div class="modal-footer">
                           <a href="{{route('deleteNovedades',$novedad->id)}}" class="btn btn-primary">Aceptar</a>   
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                       </div>
                    </div>
                </div>
            </div>
            <!-- -->  
         @endforeach                                                  
@endsection