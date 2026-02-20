<div class="modal fade" tabindex="-1" id="modalCrearEvento">
    <form id="formCrearEvento">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">
                        Agregar Evento
                    </h1>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
    
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="fv-row mb-10">
                                <label class="form-label required">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="fv-row mb-10">
                                <label class="form-label required">Descripción</label>
                                <textarea class="form-control" name="descripcion" placeholder="Descripción" required id="" cols="30" rows="3" data-kt-autosize="true"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="fv-row mb-10">
                                <label class="form-label">URL</label>
                                <input type="text" placeholder="URL" name="url" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="fv-row mb-10">
                                <label class="form-label required">Fecha Inicio</label>
                                <input class="form-control" placeholder="Fecha inicio" name="fecha_inicio" id="kt_datepicker_1" required/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="fv-row mb-10">
                                <label class="form-label required">Hora</label>
                                <input class="form-control" placeholder="Hora"  name="hora_inicio" id="kt_datepicker_2" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="fv-row mb-10">
                                <label class="form-label required">Fecha Fin</label>
                                <input class="form-control" placeholder="Fecha fin" name="fecha_fin" id="kt_datepicker_3" required/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="fv-row mb-10">
                                <label class="form-label required">Hora</label>
                                <input class="form-control" placeholder="Hora" name="hora_fin" id="kt_datepicker_4" required/>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" tabindex="-1" id="modalEditarEvento">
    <form id="formEditarEvento">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">
                        Editar Evento
                    </h1>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
    
                <div class="modal-body">
                    <div class="seccionEditar"></div>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger btnBorrar">
                        <i class="far fa-trash-alt text-white"></i>
                    </button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </form>
</div>