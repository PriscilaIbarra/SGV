@extends('layouts.app')

@section('content')
       <center>
				<strong>
					<label>
					          Asignatura: {{ $vacante->asig_desc }} 
					</label>
						<br>
					<label>
					          Tipo Cargo: {{ $vacante->desc_tipo_cargo }}
					</label>
				</strong>
				<div class="col-md-6 mt-4 mb-4">
					<div class="card">
						<div class="card-header">
							<strong>Formulario de Inscripción</strong>
						</div>
						<div class="card-body">
								<form action="PantallaPostulanteConInscripciones.html">
										<div class="form-row">
											<div class="col-md-6 mt-4 text-left">
												<label>Nombre</label>
												<input type="text" id="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" placeholder="Nombre" required >
												  @error('nombre')
				                                   <span class="invalid-feedback" role="alert">
				                                       <strong>{{ $message }}</strong>
				                                   </span>
				                                  @enderror   
											</div>
											<div class="col-md-6 mt-4 text-left">
												<label for="validationDefault02">Apellido</label>
												<input type="text" class="form-control @error('apellido') is-invalid @enderror" 
												    id="apellido" placeholder="apellido" name="apellido" required>
												@error('apellido')
				                                   <span class="invalid-feedback" role="alert">
				                                       <strong>{{ $message }}</strong>
				                                   </span>
				                                @enderror 	
											</div>
											</div>
											<div class="form-row">
												<div class="col-md-6 mt-4 text-left">
													<label for="validationDefault03">DNI/Pasaporte</label>
													<input type="text" name="dni" class="form-control" id="validationDefault03" placeholder="DNI/Pasaporte" required>
												</div>
												<div class="col-md-6 mt-4 text-left">
													<label for="validationDefault04">Teléfono</label>
													<input type="text" name="tel" class="form-control" id="validationDefault04" placeholder="Teléfono" required>
												</div>
												</div>
												<div class="form-row">
												<div class="col-md-6 mt-4 text-left">
													<label for="exampleInputEmail1">Email</label>
													<input type="email" class="form-control" id="exampleInputEmail1" 
													aria-describedby="emailHelp" placeholder="Email" required name="email">
												</div>
												<div class="col-md-6 mt-4 text-left">
											        <label class="control-label" for="fichero1">Curriculum Vitae</label>
													<input class="form-control" type="file" name="cv" required>
												</div>
												</div>
												<div class="form-row">
												<label class="text-left ml-1 mt-4">
												   			 Novedades que le gustaria recibir:
												</label>
												</div>
												@for($i=0;$i < count($novedades);$i=$i+3)
												<div class="form-row">
												    @if(isset($novedades[$i]))											
													<div class="col float-left">
														<div class="form-check float-left">
															<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
															<label class="form-check-label text-left" for="defaultCheck1">
																{{$novedades[$i]->descripcion}}
															</label>
														</div>													
													</div>
													@endif
													@if(isset($novedades[$i+1]))
													<div class="col">
														<div class="form-check float-left">
															<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
															<label class="form-check-label text-left" for="defaultCheck1">
																{{$novedades[$i+1]->descripcion}}	
														</label>
														</div>													
													</div>
													@endif
												    @if(isset($novedades[$i+2]))
													<div class="col">
															<div class="form-check float-left">
																<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
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