@extends('layouts.app')

@section('content')
 

 <center>
     <div class="col-md-8 mt-4">
                <div class="card">
                  <div class="card-header">
                        Asignación jefe de catedra
                    </div>                   
                    <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="sticky-top bg-light" style="z-index: 1;"   scope="col">Id</th>
                                            <th class="sticky-top bg-light" style="z-index: 1;"   scope="col">Asignatura</th>
                                            <th colspan="2" class="sticky-top bg-light" style="z-index: 1;"  scope="col">Jefe de catedra</th>
                                        </tr>
                                       
                                        </thead>
                                        <tbody>
                                           @foreach($asignaturas as $asignatura)    
                                        <tr>
                                            <th scope="row">{{$asignatura->id}}</th>
                                            <td>{{$asignatura->descripcion}}</td>
                                            <td scope="col">
                                               <form action="{{route('registarAsigJefC')}}" method="post" class="form-inline">
                                                @csrf
                                                <div class="row">
                                                  <input type="hidden" name="asignatura" value="{{$asignatura->id}}">

                                                  <div class="col">                             
                                                    
                                                    @if(isset($asignatura->id_jefe_catedra_calificador))
                                                       <select   name="id_jefe_catedra" class="form-control" placeholder="Usuario" required>
                                                           @foreach($jefesCatedra as $jefeCatedra)
                                                              @if($asignatura->id_jefe_catedra_calificador == $jefeCatedra->id)
                                                              <option selected value="{{$jefeCatedra->id}}">{{$jefeCatedra->nombre}},{{$jefeCatedra->apellido}}</option>
                                                              @else                                            
                                                              <option value="{{$jefeCatedra->id}}">{{$jefeCatedra->nombre}},{{$jefeCatedra->apellido}}</option>
                                                              @endif                              
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <select   name="id_jefe_catedra" class="form-control" placeholder="Usuario" required>
                                                             <option>Seleccionar</option>
                                                            @foreach($jefesCatedra as $jefeCatedra)
                                                              <option value="{{$jefeCatedra->id}}">{{$jefeCatedra->nombre}},{{$jefeCatedra->apellido}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif 
                                                  </div>
                                                   <div class="col">
                                                     <button type="submit" class=" col btn btn-outline-primary">
                                                     Guardar
                                                    </button> 
                                                   </div>
                                                  
                                                </div>
                                           
                                               
                                           </form>
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
                </div>        
        </center>                                               
@endsection