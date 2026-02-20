@extends('layouts.app')
  
@section('content')
<div class="d-flex flex-center flex-column flex-column-fluid">
    <div class="w-lg-600px p-10 p-lg-15 mx-auto">
        <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('2fa') }}" method="POST"
            id="formGoogle2FA" data-kt-redirect-url='{{ route('home') }}'>
            @csrf
            <div class="text-center mb-10">
            <h1 class="text-blue fs-3qx mb-3 ">Verificación doble</h1>

            <div class="text-gray fw-semibold fs-3">
            Ingrese la clave enviada a su aplicación de autenticación. Asegúrese de enviar el código actual.
                    </div>
            </div>

            @if($errors->any())
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>{{$errors->first()}}</strong>
                    </div>
                </div>
            @endif
            
            <div class="fv-row mb-10 fv-plugins-icon-container">
                <div id="pinwrapper" class="text-center"></div>
                <input class="form-control form-control-lg " type="hidden" placeholder="Ingrese el código" id="campoCodigo" name="one_time_password">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                <button type="submit" id="btnGoogle2FA" class="btn btn-lg btn-primary-gijac fw-bold me-4 flex-grow-1">
                    <span class="indicator-label">
                        Enviar
                    </span>
                    <span class="indicator-progress">
                        Enviando...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </form>

        <div>
                <br>
                <hr>
            </div>

            <div>
            <div class="mt-4 text-end border p-3 rounded border-2 border-gray mt-8"><span class="fs-4">Volver a </span><a href="{{route('password.request')}}" class="text-link-blue fs-4 ">inicio de sesión
                        </a></div>
            </div>

    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/google2fa/principal.js') }}"></script>
@endsection