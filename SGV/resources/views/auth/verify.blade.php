@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recuperar Contraseña') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un Email a sido enviado a su casilla de correo para completar el proceso de recuperación.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, chequee su email con mensaje de confirmación.') }}
                    {{ __('Si usted no recibió su mail') }}, <a href="{{ route('verification.resend') }}">{{ __('click aquí para solicitar otro') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
