<div class="modal fade" id="modalCrearTarea" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header flex-stack">
                <h5 class="modal-title text-blue-title" style="font-size: 30px;">Crear Tarea</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <i class="las la-times fs-1"></i>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body scroll-y pt-10 pb-15 px-lg-17">
                <form id="formCrearTarea" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Fase/Actividad</span>
                        </label>
                        <select name="id_actividad" id="selectActividad" data-placeholder="Seleccione la actividad" class="form-control"></select>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Titulo</span>
                            <span class="ms-1" data-bs-toggle="tooltip"
                                aria-label="Este titulo aparecera resaltado en la tarea."
                                data-bs-original-title="Este titulo aparecera resaltado en la tarea.">
                                <i class="fas fa-info-circle text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Titulo de la tarea"
                            name="titulo" required>
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <label class="required fs-6 fw-semibold mb-2">Responsable</label>
                        <select class="form-select form-select-solid" id="selectResponsablesTareas" multiple
                            name="responsable" required>
                        </select>
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <label class="required fs-6 fw-semibold mb-2">Fecha Inicio</label>
                            <div class="position-relative d-flex align-items-center">
                                <i class="fas fa-calendar-alt position-absolute ms-4 mb-1 fs-2"><span
                                        class="path1"></span><span class="path2"></span><span
                                        class="path3"></span><span class="path4"></span><span
                                        class="path5"></span><span class="path6"></span></i>
                                <input class="form-control form-control-solid ps-12 flatpickr-input"
                                    placeholder="Seleccione la fecha inicio" name="fecha_inicio" type="text"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Fecha Fin</label>
                            <div class="position-relative d-flex align-items-center">
                                <i class="fas fa-calendar-alt position-absolute ms-4 mb-1 fs-2"><span
                                        class="path1"></span><span class="path2"></span><span
                                        class="path3"></span><span class="path4"></span><span
                                        class="path5"></span><span class="path6"></span></i>
                                <input class="form-control form-control-solid ps-12 flatpickr-input"
                                    placeholder="Seleccione la fecha fin" name="fecha_fin" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-semibold mb-2">Descripción</label>
                        <textarea class="form-control form-control-solid" rows="3" name="descripcion"
                            placeholder="Descripción de la tarea"></textarea>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="">Etiquetas</span>
                            <span class="ms-1" data-bs-toggle="tooltip"
                                aria-label="Las etiquetas te ayudaran a buscar una tarea de manera mas facil."
                                data-bs-original-title="Las etiquetas te ayudaran a buscar una tarea de manera mas facil.">
                                <i class="fas fa-info-circle text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <input class="form-control form-control-solid" value="" name="etiquetas"
                            id="tagEtiquetas">
                    </div>
                    <div class="d-flex flex-stack mb-8">
                        <label class="fs-6 fw-semibold mb-2">Presupuesto</label>
                        <div class="position-relative w-md-300px" data-kt-dialer="true" data-kt-dialer-min="0"
                            data-kt-dialer-max="900000000" data-kt-dialer-step="10000" data-kt-dialer-prefix="$"
                            data-kt-dialer-decimals="0">

                            <!--begin::Decrease control-->
                            <button type="button"
                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                data-kt-dialer-control="decrease">
                                <i class="fas fa-minus fs-1"><span class="path1"></span><span
                                        class="path2"></span></i> </button>
                            <!--end::Decrease control-->

                            <!--begin::Input control-->
                            <input type="text" class="form-control form-control-solid border-0 ps-12"
                                data-kt-dialer-control="input" required placeholder="Amount" name="valor"
                                value="">
                            <!--end::Input control-->

                            <!--begin::Increase control-->
                            <button type="button"
                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                data-kt-dialer-control="increase">
                                <i class="fas fa-plus fs-1"><span class="path1"></span><span
                                        class="path2"></span><span class="path3"></span></i> </button>
                            <!--end::Increase control-->
                        </div>
                    </div>
                    <div class="d-flex flex-stack mb-8">
                        <div class="me-5">
                            <label class="fs-6 fw-semibold">Notificar a responsable</label>
                        </div>
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" checked="checked"
                                name="notificar_responsable">
                            <span class="form-check-label fw-semibold text-muted">
                                Si
                            </span>
                        </label>
                    </div>

                    <div class="text-center">
                        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3"
                            data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary-gijac">
                            <span class="indicator-label">
                                Agregar
                            </span>
                            <span class="indicator-progress">
                                Cargando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
