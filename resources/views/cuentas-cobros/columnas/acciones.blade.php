<div>
    <button type="button" class="btn btn-bg-secondary rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="30px, 30px">
        <i class="fas fa-ellipsis-h"></i>
    </button>

    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px btnAccionesCuentaCobro" data-kt-menu="true">
        <div class="menu-item px-3">
            <a href="{{ route('cuentas-cobros.ver', ['cuenta' => $model->id]) }}" class="menu-link fs-5 px-3 btnVer" target="_blank">
                <i class="far fa-eye text-gray fs-4 m-2"></i>
                Ver
            </a>
        </div>
        @if ($puedeEditar)
            <div class="menu-item px-3">
                <a href="{{ route('cuentas-cobros.edit', ['cuenta' => $model->id]) }}" class="menu-link fs-5 px-3">
                    <i class="fas fa-pencil-alt text-gray fs-4 m-2"></i>
                    Editar
                </a>
            </div>
            <div class="menu-item px-3">
                @if ($model->estado == 1)
                    <a href='#' class='menu-link fs-5 px-3 btnInactivar' data-cuenta='{{$model->id}}'>
                        <i class='far fa-times-fas fa-clock text-gray fs-4 m-2'></i>
                        Inactivar
                    </a>
                @else
                    <a href='#' class='menu-link fs-5 px-3 btnActivar' data-cuenta='{{$model->id}}'>
                        <i class='fas fa-check-circle text-gray fs-4 m-2'></i>
                        Activar
                    </a>
                @endif
            </div>
        @endif
        @if ($puedeEliminar)
            <div class="menu-item px-3">
                <a href="#" class="menu-link fs-5 px-3 btnEliminar" data-cuenta="{{$model->id}}">
                    <i class="fas fa-trash text-gray fs-4 m-2"></i>
                    Eliminar
                </a>
            </div>
        @endif
    </div>
</div>
