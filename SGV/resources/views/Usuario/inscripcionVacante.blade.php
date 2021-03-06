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
														<input type="text" readonly="true" class="form-control" value="{{ $vacante->asignatura->descripcion }}"> 
													</div>
													<div class="col-md-6 mt-4 text-left">											
														<label>
															<strong>Tipo de cargo:</strong>
														</label>
														<input type="text" class="form-control" readonly="true" value="{{ $vacante->tipo_cargo->descripcion }}">	
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
														<input id="cv" class="form-control @error('cv') is-invalid @enderror" type="file" name="cv" required accept="application/pdf">
														@error('cv')
						                                   <span class="invalid-feedback" role="alert">
						                                       <strong>{{ $message }}</strong>
						                                   </span>
						                                @enderror 	
													</div>
												</div>											
												
												<button class="btn btn-primary mt-4 float-right" type="submit">Confirmar Inscripción
												</button>
										</form>
						</div>
					</div>

					
						 @if(session('success'))
                    <div class=" col-md-6 float-left mt-2 alert alert-success alert-dismissible fade show" role="alert">
                          <strong>{{session('success')}}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          @endif
                    </div>
				</div>					  
				</center>

@endsection