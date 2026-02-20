@php
    $disabled = !can('proyectos.editar') && !can('proyectos.eliminar') ? 'disabled' : '';
    $disabledEliminar = !can('proyectos.eliminar') ? false : true;
@endphp
<div class="card">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title fs-2hx fw-bold f-titulo mt-3">Configuraciones del proyecto</div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->

    <!--begin::Form-->
    <form id="formEditarProyecto" class="form fv-plugins-bootstrap5 fv-plugins-framework">
        <input type="hidden" name="id" value="{{$proyecto->id}}">
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-5">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Logo del proyecto</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline" data-kt-image-input="true"
                        style="background-image: url('{{asset('assets/media/svg/brand-logos/volicity-9.svg')}}')">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-125px h-125px bgi-position-center"
                            style="background-size: 75%; background-image: url('{{asset($proyecto?->logo)}}')">
                        </div>
                        <!--end::Preview existing avatar-->

                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Caragar Logo"
                            data-bs-original-title="Caragar Logo" >
                            <i class="las la-pencil-alt fs-7"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <!--begin::Inputs-->
                            <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                            <input type="hidden" name="avatar_remove">
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->

                        <!--begin::Cancel-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancelar Logo"
                            data-bs-original-title="Cancelar Logo" >
                            <i class="las la-times fs-2"><span class="path1"></span><span
                                    class="path2"></span></i> </span>
                        <!--end::Cancel-->

                        <!--begin::Remove-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                            data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remover Logo"
                            data-bs-original-title="Remover Logo" >
                            <i class="las la-times fs-2"><span class="path1"></span><span
                                    class="path2"></span></i> </span>
                        <!--end::Remove-->
                    </div>
                    <!--end::Image input-->

                    <!--begin::Hint-->
                    <div class="form-text">Tipos de archivos permitidos: png, jpg, jpeg.</div>
                    <!--end::Hint-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Nombre del proyecto</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                    <input type="text" {{$disabled}} class="form-control form-control-solid" required name="nombre" value="{{$proyecto?->nombre}}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Tipo de proyecto</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                    <input type="text" {{$disabled}} class="form-control form-control-solid" name="tipo"
                        value="{{$proyecto?->tipo}}" required>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Descripción del proyecto</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                    <textarea name="descripcion" {{$disabled}} class="form-control form-control-solid h-100px">{!! html_entity_decode($proyecto?->descripcion ?? '', ENT_QUOTES, 'UTF-8') !!}
                    </textarea>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--begin::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Owner Responsable Gestor</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                    <select name="responsable_id" {{$disabled}} class="form-control" id="selectOwmer" data-control="select2" data-placeholder="Seleccione el Owner" data-allow-clear="true" required>
                        <option value=""></option>
                        @foreach ($responsables as $item)
                            <option value="{{$item->id}}" {{$proyecto->responsable_id == $item->id ? 'selected' : ''}}>{{$item->nombre_completo}}</option>
                        @endforeach
                    </select>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--begin::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Cliente</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                    <select name="cod_cliente" class="form-control" {{$disabled}} id="selectCliente" data-control="select2" data-placeholder="Seleccione el Owner" data-allow-clear="true" required>
                        <option value=""></option>
                        @foreach ($clientes as $item)
                            <option value="{{$item->id}}" {{$proyecto->cod_cliente == $item->id ? 'selected' : ''}}>{{$item->nombre_completo}}</option>
                        @endforeach
                    </select>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--begin::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Fecha Inicio / Fecha Finalización</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                    <div class="position-relative d-flex align-items-center">
                        <i class="fas fa-calendar-alt position-absolute ms-4 mb-1 fs-2"><span
                                class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                        <input class="form-control form-control-solid ps-12 flatpickr-input" {{$disabled}} name="fecha_inicio" value="{{$proyecto->fecha_inicio}}"
                            placeholder="Pick a date" id="fecha_inicio" type="text" required>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--begin::Col-->

                <div class="col-xl-1 fv-row fv-plugins-icon-container"></div>

                <!--begin::Col-->
                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                    <div class="position-relative d-flex align-items-center">
                        <i class="fas fa-calendar-alt position-absolute ms-4 mb-1 fs-2"><span
                                class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                        <input class="form-control form-control-solid ps-12 flatpickr-input" {{$disabled}} name="fecha_fin" value="{{$proyecto->fecha_fin}}"
                            placeholder="Pick a date" id="fecha_fin" type="text" required>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--begin::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Fecha Inicio Garantia / Fecha Finalización Garantia</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                    <div class="position-relative d-flex align-items-center">
                        <i class="fas fa-calendar-alt position-absolute ms-4 mb-1 fs-2"><span
                                class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                        <input class="form-control form-control-solid ps-12 flatpickr-input" {{$disabled}} name="fecha_inicio" value="{{$proyecto->fecha_inicio_garantia}}"
                            placeholder="Pick a date" id="fecha_inicio_garantia" type="text" required>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--begin::Col-->

                <div class="col-xl-1 fv-row fv-plugins-icon-container"></div>

                <!--begin::Col-->
                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                    <div class="position-relative d-flex align-items-center">
                        <i class="fas fa-calendar-alt position-absolute ms-4 mb-1 fs-2"><span
                                class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                        <input class="form-control form-control-solid ps-12 flatpickr-input" {{$disabled}} name="fecha_fin" value="{{$proyecto->fecha_fin_garantia}}"
                            placeholder="Pick a date" id="fecha_fin_garantia" type="text" required>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--begin::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Responsables</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                    <select multiple="multiple" {{$disabled}} id="selectResponsables" name="responsables">
                    </select>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--begin::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Notificaciones</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9">
                    <div class="d-flex fw-semibold h-100">
                        <div class="form-check form-check-custom form-check-solid me-9">
                            <input class="form-check-input" disabled checked {{$proyecto?->email ? 'checked' : ''}} type="checkbox" name="email" id="email">
                            <label class="form-check-label ms-3 fs-3 text-gris" for="email">
                                Email
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" disabled {{$proyecto?->tel ? 'checked' : ''}} type="checkbox" name="tel" id="tel">
                            <label class="form-check-label ms-3 fs-3 text-gris" for="tel">
                                Telefono
                            </label>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            @if (auth()->user()->id == $proyecto->responsable_id)
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-xl-3">
                        <div class="fs-3 fw-semibold mt-2 mb-3 fs-3 text-gris">Estado</div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-9">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" id="status"
                                name="estado" {{$proyecto?->estado == 3 ? 'checked' : ''}}>
                            <label class="form-check-label  fw-semibold text-gray-500 ms-3 fs-3 text-gris" for="status">
                                Finalizado
                            </label>
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            @endif
        </div>
        <!--end::Card body-->

        @canany(['proyectos.editar', 'proyectos.eliminar'])
            <!--begin::Card footer-->
            <div class="p-4 d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light me-2">Cancelar</button>
                @if ($disabledEliminar)
                    <button type="button" class="btn btn-eliminar me-2 btnEliminarProyecto" data-proyecto="{{$proyecto->id}}">Eliminar</button>
                @endif
                <button type="submit" class="btn btn-primary-gijac">Actualizar</button>
            </div>
            <!--end::Card footer-->
        @endcanany
        <input type="hidden">
    </form>
    <!--end:Form-->
</div>
