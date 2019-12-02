<nav class="navbar navbar-expand-sm bg-light navbar-info justify-content-end navbar-light">
              <a class="navbar-brand"  > <!--{{ config('app.name', 'SGV') }}-->SGV</a>
                 <button class="navbar-toggler mb-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="col-md-9">
                        
                    </div>
                    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                       
                        <ul class="navbar-nav text-right">
                            <!-- Authentication Links -->
                             @guest
                                <li class="nav-item active">
                                    <a href="{{ route('login') }}" class="col btn btn-success ml-md-1 mr-0 mr-md-1">
                                            {{ __('Ingresar') }}
                                    </a>
                                </li>                                
                                <li class="nav-item active">
                                    <div class="mt-2">
                                        
                                    </div>  
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item active">
                                    <a href="{{ route('register') }}" class=" col btn btn-primary ml-md-2 mr-md-2 mb-2">
                                          Registrarse
                                    </a>
                                </li>
                                @endif
                             @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{Auth::user()->apellido}}, {{Auth::user()->nombre }} 
                                        <span class="caret"></span>
                                        
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">                                     
                                        @switch(Auth::user()->id_tipo_usuario)
                                            @case(1)
                                                <span>
                                                    <a class="dropdown-item" href="{{route('asignConVacants')}}">Vacantes disponibles</a>
                                                    <a class="dropdown-item" href="{{route('listadoInscripciones')}}">Inscripciones realizadas</a>                                          
                                                </span>
                                                @break

                                            @case(2)
                                                <span>                                               
                                                   <a class="dropdown-item" href="{{ route('abmlUsuarios') }}">Usuarios</a>
                                                   <a class="dropdown-item" href="{{route('abmlVacantes')}}">Vacantes</a>
                                                   <a class="dropdown-item" href="{{ route('abmlTipoCargo') }}">Tipos de Cargos</a>
                                                   <a class="dropdown-item" href="{{ route('abmlTiposUsuarios') }}">Tipos de Usuarios</a>
                                                   <a class="dropdown-item" href="{{ route('abmlNovedades') }}">Novedades</a> 
                                                   <a class="dropdown-item" href="{{route('asignarJefesDeCatedra')}}">Asignar Jefes de Cátedra</a>
                                               </span>
                                                @break

                                            @case(3)
                                                <span>
                                                    <a class="dropdown-item" href="{{ route('homeJefeCatedra') }}">Ordenes a confeccionar</a>
                                                    <a class="dropdown-item" href="{{ route('listarOrdenesDeMerito') }}">Ordenes confeccionadas</a>
                                                </span>
                                                @break    
                                           
                                        @endswitch
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="">Cambiar Contraseña</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Salir') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                              @endguest
                        </ul>
                    </div>
</nav>