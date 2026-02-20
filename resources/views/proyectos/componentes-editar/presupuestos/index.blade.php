@php
    $disabled = !can('presupuestos.crear') && !can('presupuestos.editar') ? 'disabled' : '';
    $color = 'success';
    if ($presupuesto) {
        if ($presupuesto?->valor_gastador > $presupuesto?->valor){
            $color = 'danger';
        } elseif ((($presupuesto?->valor_gastador / $presupuesto?->valor) * 100) >= 75 && (($presupuesto?->valor_gastador / $presupuesto?->valor) * 100) < 100) {
            $color = 'warning';
        }
    }
@endphp
<form class="form" id="{{$presupuesto ? 'formEditarPresupuesto' : 'formCrearPresupuesto'}}">
    <input type="hidden" name="cod_proyecto" value="{{$proyecto?->id}}">
    <input type="hidden" name="id" value="{{$presupuesto?->id ?? ''}}">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card header-->
            <div class="card-title fs-2hx fw-bold f-titulo mt-3">Presupuesto del proyecto</div>
            <!--end::Card header-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Estado actual</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9">
                    <!--begin::Progress-->
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between w-100 fs-3 fw-bold mb-3">
                            <span class="fs-2">Presupuesto</span>
                            <span>${{formatoMiles($presupuesto?->valor_gastador) ?? 0}} de ${{formatoMiles($presupuesto?->valor) ?? 0}} usados</span>
                        </div>

                        <div class="h-8px bg-light-bar rounded mb-3">
                            <div class="bg-{{$color}} rounded h-8px" role="progressbar" style="width: {{$presupuesto?->valor && $presupuesto?->valor_gastador ? (($presupuesto?->valor_gastador / $presupuesto?->valor) * 100) : 0}}%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class=" fw-semibold text-gray-600">Quedan {{$total_tareas ?? 0}} objetivos</div>
                    </div>
                    <!--end::Progress-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Notas de presupuesto</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9">
                    <textarea name="descripcion" {{$disabled}} class="form-control form-control-solid h-100px" required>{{$presupuesto?->descripcion ?? ''}}</textarea>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Administrar presupuesto</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9">
                    <!--begin::Dialer-->
                    <div class="position-relative w-md-300px" data-kt-dialer="true" data-kt-dialer-min="0"
                        data-kt-dialer-max="900000000" data-kt-dialer-step="10000" data-kt-dialer-prefix="$"
                        data-kt-dialer-decimals="0">

                        <!--begin::Decrease control-->
                        <button type="button" {{$disabled}}
                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                            data-kt-dialer-control="decrease">
                            <i class="fas fa-minus fs-1"><span class="path1"></span><span
                                    class="path2"></span></i> </button>
                        <!--end::Decrease control-->

                        <!--begin::Input control-->
                        <input type="text" {{$disabled}} class="form-control form-control-solid border-0 ps-12"
                            data-kt-dialer-control="input" required placeholder="Amount" name="valor"
                            value="{{$presupuesto?->valor ? '$'.$presupuesto?->valor : ''}}">
                        <!--end::Input control-->

                        <!--begin::Increase control-->
                        <button type="button" {{$disabled}}
                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                            data-kt-dialer-control="increase">
                            <i class="fas fa-plus fs-1"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></i> </button>
                        <!--end::Increase control-->
                    </div>
                    <!--end::Dialer-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <div class="fs-3 fw-semibold mt-2 mb-3 text-gris">Notificaciones de uso excesivo</div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-9">
                    <!--begin::Wrapper-->
                    <div class="d-flex fw-semibold h-100">
                        <!--begin::Checkbox-->
                        <div class="form-check form-check-custom form-check-solid me-9">
                            <input class="form-check-input" disabled checked type="checkbox" value="1" id="email" {{$presupuesto?->email ? 'checked' : ''}} name="email">
                            <label class="form-check-label ms-3 fs-3" for="email">
                                Email
                            </label>
                        </div>
                        <!--end::Checkbox-->

                        <!--begin::Checkbox-->
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" disabled type="checkbox" value="1" {{$presupuesto?->tel ? 'checked' : ''}} id="tel"
                                name="tel">
                            <label class="form-check-label ms-3 fs-3" for="tel">
                                Telefono
                            </label>
                        </div>
                        <!--end::Checkbox-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

        </div>
        <!--end::Card body-->

        @canany(['presupuestos.crear', 'presupuestos.editar'])
            <!--begin::Card footer-->
            <div class="p-4 d-flex justify-content-end py-6">
                <button type="reset" class="btn btn-light me-2">Cancelar</button>
                @if ($presupuesto)
                    <button type="button" class="btn btn-eliminar me-2 btnEliminarPresupuesto" data-presupuesto="{{$presupuesto?->id}}">Eliminar</button>
                @endif
                <button type="submit" class="btn btn-primary-gijac">Guardar</button>
            </div>
            <!--end::Card footer-->
        @endcanany
    </div>
    <!--end::Card-->
</form>
