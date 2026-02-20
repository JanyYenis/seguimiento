
<div class="modal fade" tabindex="-1" id="modalCargarArchivoFase">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-blue-title" style="font-size: 30px;">Cargar Archivo</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <i class="las la-times fs-1"></i>
                    </span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form id="cargarArchivoFase" enctype="multipart/form-data" class="dropzone">
                    <div class="fv-row d-flex">
                        <div class="dz-message needsclick d-flex align-items-center">
                            <i class="las la-cloud-upload-alt fs-3x text-primary">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="ms-4 pt-6 pb-6">
                                <h3 class="fs-4 fw-bold text-gray-900 mb-1">Cargar Archivo</h3>
                                <span class="fs-5 fw-semibold text-gray-400">Arrastre o de clic aquí para cargar un archivo.
                                    Máximo 1 archivo.</span>
                            </div>
                        </div><br>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light-modal" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary-gijac-modal" id="enviarButtonFase">Cargar</button>
            </div>
        </div>
    </div>
</div>
