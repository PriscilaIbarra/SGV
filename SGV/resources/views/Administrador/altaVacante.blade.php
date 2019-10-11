@extends('layouts.app')

@section('content')
<center>
	<div class="col-md-8 mt-4 mb-3">
					<div class="card">
						<div class="card-header">
							Agregar Vacante
						</div>
						<div class="card-body">
										<form method="post"  action="{{route('agregarVacante')}}">
											 @csrf
												<div class="form-row">
												<input type="hidden" name="id_departamento" id="id_departamento" required value="{{$departamentos[0]->id}}">									
												<div class="col-md-6 mt-4 text-left">
													<label for="validationDefault01">Asignatura</label>
													<select class="form-control @error('id_asignatura') is-invalid @enderror " id="id_asignatura" name="id_asignatura" required placeholder="Asignaturas">
														@foreach($asignaturas as $asignatura)
							                                     <option value="{{$asignatura->id}}">{{$asignatura->descripcion}}
							                                     </option>
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
							                                     <option value="{{$tipo_cargo->id}}">{{$tipo_cargo->descripcion}}
							                                     </option>
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
													<input type="date" name="fechaApertura" id="fechaApertura" class="form-control @error('fechaApertura') is-invalid @enderror" required>
													@error('fechaApertura')
					                                   <span class="invalid-feedback" role="alert">
					                                       <strong>{{ $message }}</strong>
					                                   </span>
					                                @enderror  
												</div>
												<div class="col-md-6 mt-4 text-left">
													<label for="validationDefault03" class="text-left">Fecha de Cierre</label>
													<input type="date" name="fechaCierre" id="fechaCierre" required class="form-control @error('fechaCierre') is-invalid @enderror">					
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
														<input type="text" class="form-control @error('horario') is-invalid @enderror" name="horario" id="horario" placeholder="Horario" required>
														@error('horario')
					                                   	<span class="invalid-feedback" role="alert">
					                                       <strong>{{ $message }}</strong>
					                                   	</span>
					                             	 	@enderror 
													</div>
												</div>
												<div class="form-row">
													<div class="col text-left mt-3">
														<label for="validationDefault03">Requisitos</label>
														<textarea class="form-control @error('requisitos') is-invalid @enderror" name="requisitos" id="requisitos" required></textarea>
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
														<textarea class="form-control  @error('adicionales') is-invalid @enderror" name="adicionales" id="adicionales" required></textarea>
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
															<textarea class="form-control  @error('presentacion') is-invalid @enderror" name="presentacion" id="presentacion"  required></textarea>
															@error('presentacion')
							                                <span class="invalid-feedback" role="alert">
							                                       <strong>{{ $message }}</strong>
							                                </span>
							                             	@enderror 
														</div>
												</div>
												<button class="btn btn-primary mt-4 float-right" type="submit">Agregar</button>
										</form>
								</div>
						</div>
					</div>
				</div>	
	</center>							  
@endsection