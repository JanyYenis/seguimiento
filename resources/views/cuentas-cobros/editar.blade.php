@extends('layouts.index')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="contenedor" id="kt_content_container">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-column flex-lg-row-auto w-100 mb-10 mb-lg-0 h-100">
                <div class="card card-flush h-100">
                    <div class=" pt-3" id="kt_chat_contacts_header">
                    </div class="w-100">
                    <div class="card-body pt-5" id="kt_chat_contacts_body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <form id="formEditarCuentaCobro">
                                    <div id="errores">
                                        @component('sistema/div-errores')
                                        @endcomponent
                                    </div>
                                    <div class="row mb-7">
                                        <div class="col-lg-6 col-md-6">
                                            <label class="required fs-5">Fecha</label>
                                            <input type="text" name="fecha" value="{{ $cuenta->fecha }}" class="form-control" id="inputFechaCuenta" placeholder="Ingrese la fecha de la cuenta de cobro" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label class="required fs-5">Proyecto</label>
                                            <select name="cod_proyecto" id="selectProyecto" data-control="select2" data-placeholder="Seleccione el proyecto" data-allow-clear="true" class="form-control" required>
                                                <option value=""></option>
                                                @foreach ($proyectos as $item)
                                                    <option value="{{$item->id}}" {{ $cuenta?->cod_proyecto == $item?->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-7">
                                        <div class="col-lg-6 col-md-6">
                                            <label class="required fs-5">Remitente</label>
                                            <select name="cod_remitente" id="selectRemitente" data-control="select2" data-placeholder="Seleccione el remitente" data-allow-clear="true" class="form-control" required>
                                                <option value=""></option>
                                                @foreach ($remitentes as $item)
                                                    <option value="{{$item->id}}" {{ $cuenta?->cod_remitente == $item?->id ? 'selected' : '' }}>{{$item->nombre_completo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label class="required fs-5">N°. Cuenta</label>
                                            <input type="text" name="numero_cuenta" value="{{ $cuenta?->numero_cuenta ?? '' }}" class="form-control" placeholder="Ingrese el nuemro de la cuenta" required>
                                        </div>
                                    </div>
                                    <div class="row mb-7">
                                        <div class="col-lg-6 col-md-6">
                                            <label class="required fs-5">Banco</label>
                                            <input type="text" name="banco" value="{{ $cuenta?->banco ?? '' }}" class="form-control" placeholder="Ingrese el banco" required>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed border-primary my-10"></div>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modalCrearServicio">
                                            Agregar servicio
                                        </button>
                                    </div>
                                    <div class="mb-3 seccionServicios"></div>
                                </form>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <iframe
                                    id="pdf-viewer"
                                    src="{{ route('cuentas-cobros.ver', ['cuenta' => $cuenta->id]) }}"
                                    width="100%"
                                    height="500px"
                                    style="border: none;">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @component('cuentas-cobros.servicios.modals.crear')
        @slot('cuenta', $cuenta)
    @endcomponent
    @component('cuentas-cobros.servicios.modals.modals')
    @endcomponent
@endsection

@section('scripts')
    <script>window.id_cuenta = '{{$cuenta->id}}'</script>
    <script src="{{ mix('/js/cuentas-cobros/editar.js') }}" ></script>
@endsection
