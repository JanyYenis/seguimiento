@if (count($servicios))
    @foreach ($servicios as $servicio)
        <div class="row mt-3">
            <div class="col-lg-6 col-md-6">
                <label class="fs-3"><b>Servicio: </b>{{$servicio?->fase?->titulo ?? 'N/A'}}</label><br>
                <label class="fs-3"><b>Descripción: </b>{{$servicio?->fase?->descripcion ?? 'N/A'}}</label>
                <label class="fs-3"><b>Cantidad: </b>{{$servicio?->cantidad ?? 1}}</label>
                <label class="fs-3"><b>Valor Unitario: </b>${{formatoMiles($servicio?->valor ?? 0)}}</label>
                <label class="fs-3"><b>Total: </b>${{formatoMiles(($servicio?->valor ?? 0) * ($servicio?->cantidad ?? 1)) ?? 0}}</label>
            </div>
            <div class="col-lg-3 col-md-3">
                @component('sistema.estado')
                    @slot('concepto', $servicio->infoEstado)
                @endcomponent
            </div>
            <div class="col-lg-3 col-md-3">
                @component('cuentas-cobros.servicios.acciones')
                    @slot('servicio', $servicio)
                @endcomponent
            </div>
        </div>
        <div class="separator separator-dashed border-primary my-10"></div>
    @endforeach
@else
    <div class="text-center">
        <h1>Sin servicios</h1>
    </div>
@endif
