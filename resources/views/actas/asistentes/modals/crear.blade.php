<div class="modal fade" tabindex="-1" id="modalCrearAsistente">
    <form id="formCrearAsistente" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title">Crear Asistente</h1>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                        <i class="las la-times fs-1"></i>
                    </span>
                    </div>
                </div>

                <div class="modal-body">
                    <div id="errores">
                        @component('sistema/div-errores')
                        @endcomponent
                    </div>
                    <input type="hidden" name="cod_acta" value="{{ $acta?->id }}">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-7">
                            <label class="required fs-5">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de la reunion" required>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-7">
                            <label class="required fs-5">Rol</label>
                            <input type="text" name="rol" class="form-control" placeholder="Ingrese el rol" required>
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
