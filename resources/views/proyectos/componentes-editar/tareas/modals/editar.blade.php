<form id="formEditarTarea" class="form fv-plugins-bootstrap5 fv-plugins-framework">
    <input type="hidden" name="id" value="{{$tarea->id}}">
    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
            <span class="required">Fase/Actividad</span>
        </label>
        <select name="id_actividad" id="selectActividadEditar" data-placeholder="Seleccione la actividad" class="form-control"></select>
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        </div>
    </div>
    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
            <span class="required">Titulo</span>
            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Este titulo aparecera resaltado en la tarea." data-bs-original-title="Este titulo aparecera resaltado en la tarea.">
                <i class="fas fa-info-circle text-gray-500 fs-6">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </span>
        </label>
        <input type="text" class="form-control form-control-solid" placeholder="Titulo de la tarea" name="titulo" required value="{{$tarea?->titulo ?? ''}}">
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        </div>
    </div>
    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
        <label class="required fs-6 fw-semibold mb-2">Responsable</label>
        <select class="form-select form-select-solid" id="selectResponsablesTareasEdit" multiple name="responsable" required>
        </select>
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        </div>
    </div>
    <div class="row g-9 mb-8">
        <div class="col-md-6 fv-row fv-plugins-icon-container">
            <label class="required fs-6 fw-semibold mb-2">Fecha Inicio</label>
            <div class="position-relative d-flex align-items-center">
                <i class="fas fa-calendar-alt position-absolute ms-4 mb-1 fs-2"><span
                    class="path1"></span><span class="path2"></span><span class="path3"></span><span
                    class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                <input class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Seleccione la fecha inicio" name="fecha_inicio" type="text" required value="{{$tarea?->fecha_inicio}}">
            </div>
        </div>
        <div class="col-md-6 fv-row">
            <label class="required fs-6 fw-semibold mb-2">Fecha Fin</label>
            <div class="position-relative d-flex align-items-center">
                <i class="fas fa-calendar-alt position-absolute ms-4 mb-1 fs-2"><span
                    class="path1"></span><span class="path2"></span><span class="path3"></span><span
                    class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                <input class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Seleccione la fecha fin" name="fecha_fin" type="text" required value="{{$tarea?->fecha_fin}}">
            </div>
        </div>
    </div>
    <div class="d-flex flex-column mb-8">
        <label class="fs-6 fw-semibold mb-2">Descripción</label>
        <textarea class="form-control form-control-solid" rows="3" name="descripcion" placeholder="Descripción de la tarea">{{$tarea?->descripcion ?? ''}}</textarea>
    </div>
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
            <span class="">Etiquetas</span>
            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Las etiquetas te ayudaran a buscar una tarea de manera mas facil." data-bs-original-title="Las etiquetas te ayudaran a buscar una tarea de manera mas facil.">
                <i class="fas fa-info-circle text-gray-500 fs-6">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </span>
        </label>
        <input class="form-control form-control-solid" value="{{$tarea?->valor_etiqueta ?? ''}}" name="etiquetas" id="tagEtiquetasEditar">
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
                value="{{$tarea?->valor ? '$'.$tarea?->valor : ''}}">
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
    <div class="text-center">
        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">
            Cancelar
        </button>

        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary-gijac">
            <span class="indicator-label">
                Actualizar
            </span>
            <span class="indicator-progress">
                Cargando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </div>
</form>
