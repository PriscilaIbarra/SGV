@extends('layouts.app')

@section('content')
 <center>
      <div class="col-md-8 mt-4">
                <div class="card">
                  <div class="card-header">
                        Usuarios
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" scope="col">Id</th>
                                            <th class="sticky-top bg-light" scope="col">Nombre</th>
                                            <th class="sticky-top bg-light" scope="col">Apellido</th>
                                            <th class="sticky-top bg-light" scope="col">Fecha-Hora Alta</th>
                                            <th class="sticky-top bg-light" scope="col">E-mail</th>
                                            <th class="sticky-top bg-light" scope="col">Tipo</th>
                                            <th colspan="2" class="sticky-top bg-light" scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($usuarios as $usuario)    
                                        <tr>
                                            <th scope="row">{{$usuario->id}}</th>
                                            <td>{{$usuario->nombre}}</td>
                                            <td>{{$usuario->apellido}}</td>
                                            <td>{{$usuario->created_at->format('d-m-Y H:m:s')}}</td>
                                            <td>{{$usuario->email}}</td>
                                            <td>{{$usuario->descripcion}}</td>
                                            <td scope="col">
                                              @if(isset($usuario->deleted_at))
                                                <button type="button"  class="btn btn-outline-success" data-toggle="modal" data-target="#_{{$usuario->id}}">
                                                  Habilitar  &nbsp;
                                                </button>
                                              @else
                                               <button type="button"  class="btn btn-outline-danger" data-toggle="modal" data-target="#_{{$usuario->id}}">
                                                  Inhabilitar 
                                                </button>
                                              @endif                                          
                                            </td>
                                            <td scope="col">
                                                <a href="{{route('editarUsuario',$usuario->id)}}" class="btn btn-outline-primary">
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
                    <a href="{{route('altaUsuario')}}" class="float-right mt-4 btn btn-success ">       Agregar
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
         @foreach($usuarios as $usuario)        
            <!-- Modal -->
             <div class="modal fade" id="_{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="_{{$usuario->id}}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                       </div>
                       <div class="modal-body">
                             Desea cambiar el estado del usuario:<br>
                            <strong>Id: </strong>{{$usuario->id}}<br>
                            <strong>Apellido: </strong>{{$usuario->apellido}}<br>
                            <strong>Nombre: </strong>{{$usuario->nombre}}<br>                     
                       </div>
                       <div class="modal-footer">
                           <a href="{{route('deleteUsuarios',$usuario->id)}}" class="btn btn-primary">Aceptar</a>   
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                       </div>
                    </div>
                </div>
            </div>
            <!-- -->  
         @endforeach                                                  
@endsection