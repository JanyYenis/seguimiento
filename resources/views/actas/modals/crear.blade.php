<div class="modal fade" tabindex="-1" id="modalCrearActa">
    <form id="formCrearActa" enctype="multipart/form-data">
        <div class="modal-dialog modal-md modal-dialog-scrollable">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title">Crear Acta</h1>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-7">
                            <label class="required fs-5">Nombre</label>
                            <input type="text" name="nombre_reunion" class="form-control" placeholder="Ingrese el nombre de la reunion" required>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-7">
                            <label class="required fs-5">Fecha Reunión</label>
                            <input type="text" id="kt_datepicker_1" name="fecha" class="form-control" placeholder="Ingrese la fecha de la reunión" required>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-7">
                            <label class="required fs-5">Cliente</label>
                            <select name="cod_cliente" id="selectCliente" data-control="select2" data-placeholder="Seleccione el cliente" data-allow-clear="true" class="form-control" required data-dropdown-parent="body">
                                <option value=""></option>
                                @foreach ($clientes as $item)
                                    <option value="{{$item->id}}">{{$item->nombre_completo}}</option>
                                @endforeach
                            </select>
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
