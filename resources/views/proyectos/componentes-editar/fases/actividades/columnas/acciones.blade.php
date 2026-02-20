<div>
    <div>
        <button type="button" class="btn btn-bg-secondary rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="30px, 30px">
            <i class="fas fa-ellipsis-h"></i>
        </button>

        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px btnAccionesUsuarios" data-kt-menu="true">
            @if ($puedeEditar)
                <div class="menu-item px-3">
                    <a href="#" class="menu-link fs-5 px-3 btnEditarActividades" data-actividades="{{$model->id}}">
                        <i class="fas fa-pencil-alt text-gray fs-4 m-2"></i>
                        Editar
                    </a>
                </div>
                <div class="menu-item px-3">
                    @if ($model->estado == 1)
                        <a href='#' class='menu-link fs-5 px-3 btnInactivarActividad' data-actividades='{{$model->id}}'>
                            <i class='far fa-times-fas fa-clock text-gray fs-4 m-2'></i>
                            Inactivar
                        </a>
                    @else
                        <a href='#' class='menu-link fs-5 px-3 btnActivarFase' data-actividades='{{$model->id}}'>
                            <i class='fas fa-check-circle text-gray fs-4 m-2'></i>
                            Activar
                        </a>
                    @endif
                </div>
            @endif
            {{-- <div class="menu-item px-3">
                <a href="#" class="menu-link fs-5 px-3 btnCargarArchivoActividad" data-registro="{{$model->id_carpeta}}" data-registronombre="{{$model?->titulo}}">
                    <i class="las la-cloud-upload-alt text-gray fs-2x m-2"></i>
                    Cargar Archivo
                </a>
            </div> --}}
        </div>
    </div></div>
