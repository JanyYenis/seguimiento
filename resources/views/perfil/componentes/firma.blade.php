<div id="cardFirma" class="collapse show">
    <!--begin::Card body-->
    <div class="card-body border-top p-9">
        <div class="row">
            <!--begin::Email Address-->
            <div class="col-lg-8 col-md-8 d-flex flex-wrap align-items-center">
                <div class="contenedor">
                    <div class="row">
                        <div class="col-md-12 text-center mb-5">
                            <canvas id="draw-canvas" class="border-gray-300 border-dotted" width="550" height="300">
                                No tienes un buen navegador.
                            </canvas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 text-start">
                            <label class="fs-4 text-gris mb-2">Color</label>
                            <input type="color" class="form-control" id="color">
                        </div>
                        <div class='col-lg-6 col-md-6 text-start'>
                            <label class="fs-4 text-gris mb-2">Tamaño Puntero</label>
                            <input type="range" id="puntero" class='form-range' min="1" default="1"
                                max="5" width="10%">
                        </div>
                        <br>
                        <div class="col-md-12 text-center mt-4">
                            <div class="d-flex flex-column flex-md-row justify-content-center g-3">
                                <input type="button" class="btn btn-primary w-100 mb-2 mb-md-0 me-md-3 fs-4"
                                    id="draw-submitBtn" value="Crear Imagen">
                                <input type="button" class="btn btn-danger w-100 fs-4" id="draw-clearBtn"
                                    value="Borrar Canvas">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::Password-->
            <div class="col-lg-4 col-md-4 d-flex flex-wrap align-items-center mb-10">
                <div class="col-md-12">
                    <div class="">
                        <span class="fw-bold fs-2 m-0 text-gris ">Firma</span>
                    </div>
                    <div class="">
                        <img id="draw-image" src="{{ $usuario->firma ? $usuario->firma : asset('img/firma.jpg') }}"
                            alt="Tu Imagen aparecera Aqui!" width="{{ $usuario->firma ? '400' : '100%' }}" />
                    </div>
                </div>
            </div>
            <!--end::Password-->
        </div>
    </div>
    <!--end::Card body-->
</div>
