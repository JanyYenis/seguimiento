<div class="modal fade" tabindex="-1" id="modalCrearProyectos">
    <form id="formCrearProyecto" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Crear Proyecto</h1>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal"
                        aria-label="Close">
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
                    <div class="row mb-7">
                        <div class="col-lg-12 d-flex align-items-center justify-content-center">
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url({{ asset('img/logo_mini.png') }})">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url({{ asset('img/logo_mini.png') }})">
                                </div>
                                <!--end::Preview existing avatar-->

                                <!--begin::Label-->
                                <label
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Cargar Foto">
                                    <i class="las la-pencil-alt fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="file" name="logo" id="avatarUsuario" required
                                        accept="image/png, image/jpeg, image/jpg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <!--end::Label-->

                                <!--begin::Cancel-->
                                <span
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Cancel avatar">
                                    <i class="las la-times fs-3"></i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Remove avatar">
                                    <i class="las la-times fs-3"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                        </div>
                        <div class="form-text text-center">Tipos de archivos permitidos: png, jpg, jpeg.</div>
                    </div>
                    <div class="row mb-7">
                        <label class="required">Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                            placeholder="Ingrese el nombre del proyecto" required>
                    </div>
                    <div class="row mb-7">
                        <label class="required">Tipo</label>
                        <input class="form-control" required placeholder="Tipo" name="tipo" id="tipo"/>
                    </div>
                    <div class="row mb-7">
                        <label class="required">Owner Responsable Gestor</label>
                        <select name="responsable_id" class="form-control" id="selectOwmer" data-control="select2" data-placeholder="Seleccione el Owner" data-allow-clear="true" required data-dropdown-parent="body">
                            <option value=""></option>
                            @foreach ($responsables as $item)
                                <option value="{{$item->id}}">{{$item->nombre_completo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-7">
                        <label class="required">Cliente</label>
                        <select name="cod_cliente" class="form-control" id="selectCliente" data-control="select2" data-placeholder="Seleccione el Owner" data-allow-clear="true" required data-dropdown-parent="body">
                            <option value=""></option>
                            @foreach ($clientes as $item)
                                <option value="{{$item->id}}">{{$item->nombre_completo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-7">
                        <div class="col-lg-6 col-md-6">
                            <label class="required">Fecha Inicio</label>
                            <input class="form-control" required placeholder="Fecha inicio" name="fecha_inicio" id="fecha_inicio" />
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label class="required">Fecha Fin</label>
                            <input class="form-control" required placeholder="Fecha fin" name="fecha_fin" id="fecha_fin" />
                        </div>
                    </div>
                    <div class="row mb-7">
                        <div class="col-lg-6 col-md-6">
                            <label class="required">Fecha Inicio Garantia</label>
                            <input class="form-control" required placeholder="Fecha inicio garantia" name="fecha_inicio_garantia" id="fecha_inicio_garantia"/>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label class="required">Fecha Fin Garantia</label>
                            <input class="form-control" required placeholder="Fecha fin garantia" name="fecha_fin_garantia" id="fecha_fin_garantia"/>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="required">Responsables</label>
                        <select multiple="multiple" id="selectResponsables" name="responsables">
                        </select>
                    </div>


                    <div class="row mb-7">
                        <label class="required fs-3">Fases</label>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Titulo</span>
                                <span class="ms-1" data-bs-toggle="tooltip"
                                    aria-label="Este titulo aparecera resaltado en la fase."
                                    data-bs-original-title="Este titulo aparecera resaltado en la fase.">
                                    <i class="fas fa-info-circle text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <input type="text" class="form-control form-control-solid tituloFase" placeholder="Titulo del Fase"
                                name="tituloFase[]" id="tituloFase" required>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
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
                                <input type="text" class="form-control form-control-solid border-0 ps-12 valorFase"
                                    data-kt-dialer-control="input" placeholder="Amount" name="valor[]"
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
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-semibold mb-2 required">Descripción</label>
                            <textarea class="form-control form-control-solid descFase" rows="3" name="descFase[]" id="descFase"
                                placeholder="Descripción de la fase" required></textarea>
                        </div>
                    </div>
                    {{-- En este div es donde se van a agregar los nuevos Fases que se van agregando --}}
                    <div id="componentContainer"></div>
                    <a class="btn btn-primary-gijac" id="btnProyectAgregarComp" style="margin-left: 22rem">Añadir Fase</a>

                    <div class="row mb-7">
                        {{-- <div class="summernote"></div> --}}
                        <label class="required">Descripción</label>
                        <textarea name="descripcion" class="form-control form-control-solid h-100px" cols="30" rows="10"></textarea>
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
