<div class="modal fade" tabindex="-1" id="modalCrearServicio">
    <form id="formCrearServicio">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title">Agregar Servicio</h1>
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
                    <input type="hidden" name="cod_cuenta" value="{{ $cuenta?->id }}">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-7">
                            <label class="required fs-5">Servicios</label>
                            <select name="cod_fase" id="selectServicios" class="form-control" data-control="select2" data-placeholder="Seleccione el servicio" data-allow-clear="true" required></select>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-7">
                            <label class="required fs-5">Valor Unitario</label>
                            <div class="input-group w-md-300px"
                                data-kt-dialer="true"
                                data-kt-dialer-currency="true"
                                data-kt-dialer-min="1000"
                                data-kt-dialer-max="5000000"
                                data-kt-dialer-step="10000"
                                data-kt-dialer-prefix="$">

                                <!--begin::Decrease control-->
                                <button class="btn btn-icon btn-outline btn-active-color-primary" type="button" data-kt-dialer-control="decrease">
                                    <i class="fas fa-minus fs-2"></i>
                                </button>
                                <!--end::Decrease control-->

                                <!--begin::Input control-->
                                <input type="text" class="form-control" name="valor" required placeholder="Valor unitario" value="" data-kt-dialer-control="input"/>
                                <!--end::Input control-->

                                <!--begin::Increase control-->
                                <button class="btn btn-icon btn-outline btn-active-color-primary" type="button" data-kt-dialer-control="increase">
                                    <i class="fas fa-plus fs-2"></i>
                                </button>
                                <!--end::Increase control-->
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6 col-md-6">
                            <label class="required fs-5">Cantidad</label>
                            <input type="number" name="cantidad" min="1" minlength="1" required class="form-control" placeholder="Ingrese la cantidad">
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
