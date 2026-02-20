<div class="modal fade" tabindex="-1" id="modalCrearCuentaCobro">
    <form id="formCrearCuentaCobro">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title">Crear Cuenta de Cobro</h1>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                        <i class="las la-times fs-1"></i>
                    </span>
                    </div>
                </div>

                <div class="modal-body scroll h-400px px-5">
                    <div id="errores">
                        @component('sistema/div-errores')
                        @endcomponent
                    </div>
                    <div class="row mb-7">
                        <div class="col-lg-6 col-md-6">
                            <label class="required fs-5">Fecha</label>
                            <input type="text" name="fecha" class="form-control" id="inputFechaCuenta" placeholder="Ingrese la fecha de la cuenta de cobro" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label class="required fs-5">Proyecto</label>
                            <select name="cod_proyecto" id="selectProyecto" data-control="select2" data-placeholder="Seleccione el proyecto" data-allow-clear="true" class="form-control" required data-dropdown-parent="#modalCrearCuentaCobro">
                                <option value=""></option>
                                @foreach ($proyectos as $item)
                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <div class="col-lg-6 col-md-6">
                            <label class="required fs-5">Remitente</label>
                            <select name="cod_remitente" id="selectRemitente" data-control="select2" data-placeholder="Seleccione el remitente" data-allow-clear="true" class="form-control" required data-dropdown-parent="#modalCrearCuentaCobro">
                                <option value=""></option>
                                @foreach ($remitentes as $item)
                                    <option value="{{$item->id}}">{{$item->nombre_completo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label class="required fs-5">N°. Cuenta</label>
                            <input type="text" name="numero_cuenta" class="form-control" placeholder="Ingrese el nuemro de la cuenta" required>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <div class="col-lg-6 col-md-6">
                            <label class="required fs-5">Banco</label>
                            <input type="text" name="banco" class="form-control" placeholder="Ingrese el banco" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary-gijac">Crear</button>
                </div>
            </div>
        </div>
    </form>
</div>
