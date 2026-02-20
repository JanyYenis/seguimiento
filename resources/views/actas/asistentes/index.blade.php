@if (count($asistentes))
    @foreach ($asistentes as $asistente)
        <div class="row mt-3">
            <div class="col-lg-6 col-md-6">
                <label class="fs-3"><b>Nombre: </b>{{$asistente?->nombre ?? 'N/A'}}</label><br>
                <label class="fs-3"><b>Rol: </b>{{$asistente?->rol ?? 'N/A'}}</label>
            </div>
            <div class="col-lg-3 col-md-3">
                @component('sistema.estado')
                    @slot('concepto', $asistente->infoEstado)
                @endcomponent
            </div>
            <div class="col-lg-3 col-md-3">
                @component('actas.asistentes.acciones')
                    @slot('asistente', $asistente)
                @endcomponent
            </div>
        </div>
        <div class="separator separator-dashed border-primary my-10"></div>
    @endforeach
@else
    <div class="text-center">
        <h1>Sin asistentes</h1>
    </div>
@endif
