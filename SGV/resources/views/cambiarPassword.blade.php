@extends('layouts.app')
@section('content')
       <center>
			<div class="col-md-6 mt-4 mb-4">
					<div class="card">
						<div class="card-header">
							<strong>Formulario de Inscripción</strong>
						</div>
						<div class="card-body">
                              <div class="text-center">
								<form  action="{{route('actualizarPassword')}}" method="post">
									 @csrf
								       	  <div class="form-row mr-auto">													
													<div class="col mt-4 text-left">											
														<label>
															<strong>Contraseña Actual:</strong>
														</label>
														<input type="password" name="passwordActual" class="form-control 	 @error('passwordActual') is-invalid @enderror"  required>
														  @error('passwordActual')
						                                   <span class="invalid-feedback" role="alert">
						                                       <strong>{{ $message }}</strong>
						                                   </span>
						                                  @enderror   	
													</div>
										   </div>
										   <div class="form-row">
										   	      <div class="col mt-4 text-left">
														<label>
															 <strong>Constraseña Nueva:</strong>
														</label>
														<input type="password" name="passwordNuevo"  class="form-control @error('passwordNuevo') is-invalid @enderror" required > 
														  @error('passwordNuevo')
						                                   <span class="invalid-feedback" role="alert">
						                                       <strong>{{ $message }}</strong>
						                                   </span>
						                                  @enderror  
											     </div>
										   </div>
										   <div class="form-row">
										   	      <div class="col mt-4 text-left">
														<label>
															 <strong>Confirmar Contraseña Nueva:</strong>
														</label>
														<input type="password" name="passwordConfirmar"  class="form-control @error('passwordConfirmar') is-invalid @enderror" required> 
														  @error('passwordConfirmar')
						                                   <span class="invalid-feedback" role="alert">
						                                       <strong>{{ $message }}</strong>
						                                   </span>
						                                  @enderror  
											     </div>
										   </div>
										   <button class="btn btn-primary mt-4 float-right" type="submit">Guardar
										   </button>
							    </form>	
							    </div>								
					    </div>	   
												
										
					    </div>
					</div>					
                          @if(session('error'))
                           <div class=" col-md-6 float-left mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                          		<strong>{{session('error')}}</strong>
	                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                            <span aria-hidden="true">&times;</span>
	                          </button>
	                       </div>   
                          @endif
				</div>					  
			</center>
@endsection