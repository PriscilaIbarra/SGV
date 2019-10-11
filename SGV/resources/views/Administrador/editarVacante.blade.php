@extends('layouts.app')

@section('content')
	<center>
	  <div class="col-md-8 mt-4 mb-3">
					<div class="card">
						<div class="card-header">
							Modificar Vacante
						</div>
						<div class="card-body">
										<form method="post"  action="{{route('updateVacante')}}">
											 @csrf
											 	<input type="hidden" name="id" value="{{$vacante->id}}">
												<div class="form-row">
												<input type="hidden" name="id_departamento" id="id_departamento" required value="{{$departamentos[0]->id}}">									
												<div class="col-md-6 mt-4 text-left">
													<label for="validationDefault01">Asignatura</label>
													<select class="form-control @error('id_asignatura') is-invalid @enderror " id="id_asignatura" name="id_asignatura" required placeholder="Asignaturas">
														@foreach($asignaturas as $asignatura)
														        @if($asignatura->id == $vacante->id_asignatura)
														         <option selected value="{{$asignatura->id}}">
														        	{{$asignatura->descripcion}}
							                                     </option>
														        @else
														         <option value="{{$asignatura->id}}">
														         	{{$asignatura->descripcion}}
							                                     </option>
														        @endif							                                    
							                            @endforeach
													</select>
													@error('id_asignatura')
					                                   <span class="invalid-feedback" role="alert">
					                                       <strong>{{ $message }}</strong>
					                                   </span>
					                                @enderror  
												</div>
												<div class="col-md-6 mt-4 text-left">
													<label for="validationDefault02" class="text-left">Tipo de Cargo</label>
													<select class="form-control @error('id_tipo_cargo') is-invalid @enderror" id="id_tipo_cargo" name="id_tipo_cargo" required placeholder="Tipo de Cargo">
													    @foreach($tipos_cargos as $tipo_cargo)
													      	@if($tipo_cargo->id == $vacante->id_tipo_cargo)
														         <option selected value="{{$tipo_cargo->id}}">{{$tipo_cargo->descripcion}}
							                                     </option>
														        @else
														        <option value="{{$tipo_cargo->id}}">{{$tipo_cargo->descripcion}}
							                                    </option>
														    @endif							                                     
							                            @endforeach
													</select>
													@error('id_tipo_cargo')
					                                   <span class="invalid-feedback" role="alert">
					                                       <strong>{{ $message }}</strong>
					                                   </span>
					                                @enderror  
												</div>
												</div>
												<div class="form-row">
												<div class="col-md-6 mt-4 text-left">
													<label for="validationDefault03" class="text-left">Fecha de Apertura</label>
													<input type="date" name="fechaApertura" id="fechaApertura" class="form-control @error('fechaApertura') is-invalid @enderror" required value="{{$vacante->fecha_apertura}}"> 
													@error('fechaApertura')
					                                   <span class="invalid-feedback" role="alert">
					                                       <strong>{{ $message }}</strong>
					                                   </span>
					                                @enderror  
												</div>
												<div class="col-md-6 mt-4 text-left">
													<label for="validationDefault03" class="text-left">Fecha de Cierre</label>
													<input type="date" name="fechaCierre" id="fechaCierre" required class="form-control @error('fechaCierre') is-invalid @enderror" value="{{$vacante->fecha_cierre}}">					
													@error('fechaCierre')
					                                   <span class="invalid-feedback" role="alert">
					                                       <strong>{{ $message }}</strong>
					                                   </span>
					                                @enderror 
												</div>
											    </div>
												<div class="form-row">
													<div class="col mt-4 text-left">
														<label for="validationDefault04" class="text-left">Horario</label>
														<input type="text" class="form-control @error('horario') is-invalid @enderror" name="horario" id="horario" placeholder="Horario" required value="{{$vacante->horario}}">
														@error('horario')
					                                   	<span class="invalid-feedback" role="alert">
					                                       <strong>{{ $message }}</strong>
					                                   	</span>
					                             	 	@enderror 
													</div>
												</div>
												<!--Don't let whitespaces between textarea tag and it's content -->
												<div class="form-row">
													<div class="col text-left mt-3">
														<label for="validationDefault03">Requisitos</label>
													<textarea class="form-control @error('requisitos') is-invalid @enderror" style="height:150px;" name="requisitos" id="requisitos" required>{{$vacante->requisitos}}
													</textarea>
														@error('requisitos')
					                                   	<span class="invalid-feedback" role="alert">
					                                       <strong>{{ $message }}</strong>
					                                   	</span>
					                             	 	@enderror 
													</div>
												</div>
												<div class="form-row">
													<div class="col text-left mt-3">
														<label for="validationDefault03">Adicionales</label>
														<textarea class="form-control  @error('adicionales') is-invalid @enderror" name="adicionales" id="adicionales" required  style="height:150px;">{{$vacante->adicionales}}

														</textarea>
														@error('adicionales')
					                                   	<span class="invalid-feedback" role="alert">
					                                       <strong>{{ $message }}</strong>
					                                   	</span>
					                             	 	@enderror 
													</div>
												</div>
												<div class="form-row">
														<div class="col text-left mt-3">
															<label for="validationDefault03">Presentación</label>
															<textarea class="form-control text-area-h  @error('presentacion') is-invalid @enderror"  name="presentacion" id="presentacion"  
															required style="height:150px;">{{$vacante->presentacion}}

															</textarea>
															@error('presentacion')
							                                <span class="invalid-feedback" role="alert">
							                                       <strong>{{ $message }}</strong>
							                                </span>
							                             	@enderror 
														</div>
												</div>
												<button class="btn btn-primary mt-4 float-right" type="submit">Guardar</button>
										</form>
								</div>
						</div>
					</div>
				</div>	
	</center>							  
@endsection