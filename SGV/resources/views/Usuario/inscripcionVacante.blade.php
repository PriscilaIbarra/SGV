@extends('layouts.app')
@section('content')
       <center>
			<div class="col-md-6 mt-4 mb-4">
					<div class="card">
						<div class="card-header">
							<strong>Formulario de Inscripción</strong>
						</div>
						<div class="card-body">
								<form method="post" action="{{route('registrarInscripcion')}}" enctype="multipart/form-data">
									 @csrf
								<input type="hidden" name="id_vacante" value="{{$vacante->id}}">
												<div class="form-row">
													<div class="col-md-6 mt-4 text-left">
														<label>
															 <strong>Asignatura:</strong>
														</label>
														<input type="text" readonly="true" class="form-control" value="{{ $vacante->asig_desc }}"> 
													</div>
													<div class="col-md-6 mt-4 text-left">											
														<label>
															<strong>Tipo de cargo:</strong>
														</label>
														<input type="text" class="form-control" readonly="true" value="{{ $vacante->desc_tipo_cargo }}">	
													</div>
												</div>
												<div class="form-row">												
													<div class="col mt-4 text-left">
												        <label class="control-label" for="fichero1">Disponibilidad Horaria</label>
														<input id="disponibilidad_horaria" class="form-control @error('disponibilidad_horaria') is-invalid @enderror" type="text" name="disponibilidad_horaria" required>
														@error('disponibilidad_horaria')
						                                   <span class="invalid-feedback" role="alert">
						                                       <strong>{{ $message }}</strong>
						                                   </span>
						                                @enderror 	
													</div>
												</div>
									    		<div class="form-row">												
													<div class="col mt-4 text-left">
												        <label class="control-label" for="fichero1">Curriculum Vitae</label>
														<input id="cv" class="form-control @error('cv') is-invalid @enderror" type="file" name="cv" required>
														@error('cv')
						                                   <span class="invalid-feedback" role="alert">
						                                       <strong>{{ $message }}</strong>
						                                   </span>
						                                @enderror 	
													</div>
												</div>
												<div class="dropdown-divider mt-4"></div>
												<div class="form-row">
												<label class="text-left ml-1 mt-4">
													<u> Novedades que le gustaria recibir:</u>							   			
												</label>
												</div>
												@for($i=0;$i < count($novedades);$i=$i+3)
												<div class="form-row">
												    @if(isset($novedades[$i]))											
													<div class="col float-left">
														<div class="form-check float-left">
															<input name="{{'novedad'.$novedades[$i]->id}}" class="form-check-input" type="checkbox" value="{{$novedades[$i]->id}}" id="defaultCheck1">
															<label class="form-check-label text-left" for="defaultCheck1">
																{{$novedades[$i]->descripcion}}
															</label>
														</div>													
													</div>
													@endif
													@if(isset($novedades[$i+1]))
													<div class="col">
														<div class="form-check float-left">
															<input  name="{{'novedad'.$novedades[$i+1]->id}}"class="form-check-input" type="checkbox" value="{{$novedades[$i+1]->id}}" id="defaultCheck1">
															<label class="form-check-label text-left" for="defaultCheck1">
																{{$novedades[$i+1]->descripcion}}	
														</label>
														</div>													
													</div>
													@endif
												    @if(isset($novedades[$i+2]))
													<div class="col">
															<div class="form-check float-left">
																<input name="{{'novedad'.$novedades[$i+2]->id}}" class="form-check-input" type="checkbox" value="{{$novedades[$i+2]->id}}" id="defaultCheck1">
																<label class="form-check-label text-left" for="defaultCheck1">
																{{$novedades[$i+2]->descripcion}}
																</label>
															</div>															
													</div>													
													@endif	
												 </div>																			
											     @endfor
												<button class="btn btn-primary mt-4 float-right" type="submit">Confirmar Inscripción
												</button>
										</form>
						</div>
					</div>
				</div>					  
				</center>

@endsection