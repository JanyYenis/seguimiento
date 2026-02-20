<div class="modal fade" tabindex="-1" id="modalActividades">
    <input type="hidden" name="idFase" id="idFase">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Actividades</h1>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <i class="las la-times fs-1"></i>
                    </span>
                </div>
            </div>

            <div class="modal-body">
                <div class="mb-5 hover-scroll-x">
                    <div class="d-grid">
                        <ul class="nav nav-tabs flex-nowrap text-nowrap">
                            <li class="nav-item">
                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active text-verdoso fs-2" data-bs-toggle="tab" href="#tabListado">Listado</a>
                            </li>
                            @can('actividades.crear')
                                <li class="nav-item">
                                    <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 text-verdoso fs-2" data-bs-toggle="tab" href="#tabCrear">Crear Actividad</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabListado" role="tabpanel">
                        <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto tablasScroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px" style="max-height: 410px;">
                            <div class="table-responsive">
                                <table border="1" class="table table-striped table-bordered" id="tablaActividades">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center all">#</th>
                                            <th width="10%" class="text-center all">Titulo</th>
                                            <th width="10%" class="text-center all">Descripción</th>
                                            <th width="10%" class="text-center all">Valor</th>
                                            <th width="10%" class="text-center all">Fecha inicio</th>
                                            <th width="10%" class="text-center all">Fecha fin</th>
                                            <th width="10%" class="text-center all">Estado</th>
                                            <th width="10%" class="text-center all">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabCrear" role="tabpanel">
                        <div id="errores">
                            @component('sistema/div-errores')
                            @endcomponent
                        </div>
                        <form id="formActividades">
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
                                <input type="text" class="form-control form-control-solid" placeholder="Titulo de la Actividad"
                                    name="titulo" required>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-8">
                                <label class="fs-6 fw-semibold mb-2">Descripción</label>
                                <textarea class="form-control form-control-solid" rows="3" name="descripcion"
                                    placeholder="Descripción de la Actividad"></textarea>
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
                                            placeholder="Seleccione la fecha inicio" name="fecha_inicio" type="text" id="fecha_inicioCrear"
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
                                            placeholder="Seleccione la fecha fin" name="fecha_fin" type="text" required
                                            id="fecha_finCrear">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-stack mb-8">
                                <label class="fs-6 fw-semibold mb-2">Presupuesto</label>
                                <div class="position-relative w-md-600px" data-kt-dialer="true" data-kt-dialer-min="0"
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
                                        data-kt-dialer-control="input" placeholder="Amount" name="valor"
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
                            <div class="mt-5 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary-gijac">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                {{-- <button type="submit" class="btnG btnG-primary obalado guardar">Crear</button> --}}
            </div>
        </div>
    </div>
</div>
