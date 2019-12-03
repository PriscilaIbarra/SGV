@extends('layouts.app')

@section('content')
	   <center>
		   <div class="col-md-6">
		   		<h2>SISTEMA DE GESTION DE VACANTES</h2>
		   		<img src="{{ asset('imagenes/logo.png') }}" class="mt-4" style="min-height:200px;"> 	
		   		<h3 class="mt-4">Universidad Tecnologica Nacional</h3>
		   		<h4>Facultad Regional Rosario</h4>
		   </div>
	   </center>

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
	 
	
@endsection