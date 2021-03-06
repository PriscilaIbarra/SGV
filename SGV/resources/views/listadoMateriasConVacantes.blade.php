@extends('welcome')

@section('content')
  @include('include.title&logo')
<center>
    <div class="col-md-8 mt-4 ">
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
                                            <th class="sticky-top bg-light" scope="col">Asignatura</th>
                                            <th class=" text-center sticky-top bg-light" scope="col">
                                                Información
                                            </th>                                      
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($asignaturas as $asignatura)    
                                                <tr>
                                                    <td>{{$asignatura->descripcion}}</td>
                                                    <td class="text-center">
                                                        <a href="{{route('listadoVacantes',$asignatura->id)}}" class="btn btn-outline-primary" >Consultar</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                </table>
                            </div>
                        </div>                          
                        @if(session('error'))
                        <div class=" col float-left mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>{{session('error')}}</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        @endif   
                    </div>
                     <div class="mr-auto">
                            {{$asignaturas->links()}}            
                    </div>                                                                          
                          
                </div>
                            
         </div>             
</center>
    @include('include.note')
@endsection