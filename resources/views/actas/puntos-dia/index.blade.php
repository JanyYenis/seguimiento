@if (count($puntos))
    @foreach ($puntos as $punto)
        <div class="row mt-3">
            <div class="col-lg-6 col-md-6">
                <label class="fs-3"><b>Orden: </b>{{$punto?->numero ?? 1}}</label><br>
                <label class="fs-3"><b>Punto: </b>{{$punto?->titulo ?? 'N/A'}}</label><br>
                <label class="fs-3"><b>Responsable: </b>{{$punto?->responsable?->nombre_completo ?? 'N/A'}}</label>
                <label class="fs-3"><b>Descripcion: </b>{{$punto?->descripcion ?? 'N/A'}}</label>
            </div>
            <div class="col-lg-3 col-md-3">
                @component('sistema.estado')
                    @slot('concepto', $punto->infoEstado)
                @endcomponent
            </div>
            <div class="col-lg-3 col-md-3">
                @component('actas.puntos-dia.acciones')
                    @slot('punto', $punto)
                @endcomponent
            </div>
        </div>
        <div class="separator separator-dashed border-primary my-10"></div>
    @endforeach
@else
    <div class="text-center">
        <h1>Sin puntos del día</h1>
    </div>
@endif
