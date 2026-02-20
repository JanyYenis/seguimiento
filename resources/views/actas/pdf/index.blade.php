@extends('pdfs.index', ['titulo' => 'Acta de reunión'])

@section('content')
    <div class="text-center">
        <b class="text-primary-gijac" style="font-size: 2.5rem;">Acta de Reunión N°. {{ $acta->numero }}</b>
    </div>

    <div class="pdf-row mt-3">
        <div class="pdf-col" style="width: 50%;">
            <b class="titulo">Nombre Reunión:</b><br>
            <label class="fs-5">{{$acta?->nombre_reunion ?? 'N/A'}}</label>
        </div>
        <div class="pdf-col" style="width: 50%;">
            <b class="titulo">Nombre Proyecto:</b><br>
            <label class="fs-5">{{$acta?->proyecto?->nombre ?? 'N/A'}}</label>
        </div>
    </div>

    <div class="pdf-row mt-3">
        <div class="pdf-col" style="width: 50%;">
            <b class="titulo">Fecha Reunión:</b><br>
            <label class="fs-5">{{$acta?->fecha->format('d/m/Y g:i a') ?? 'N/A'}}</label>
        </div>
        <div class="pdf-col" style="width: 50%;">
            <b class="titulo">Fecha Proxima Reunión:</b><br>
            <label class="fs-5">{{$acta?->fecha_proxima_reunion ? $acta?->fecha_proxima_reunion->format('d/m/Y g:i a') : 'N/A'}}</label>
        </div>
    </div>

    <div class="pdf-row mt-3">
        <div class="pdf-col" style="width: 48%;">
            <b class="titulo">Asistentes:</b><br>
            @if (count($acta->asistentesActivos))
                <ul>
                    @foreach ($acta->asistentesActivos as $item)
                        <li class="fs-6">{{($item?->nombre ?? 'N/A')}} - {{($item?->rol ?? 'N/A')}}</li>
                    @endforeach
                </ul>
            @else
                <label class="fs-5">No tiene asitentes.</label>
            @endif
        </div>
        <div style="width: 2%;"></div>
        <div class="pdf-col" style="width: 50%;">
            <b class="titulo">Cliente:</b><br>
            <label class="fs-5">{{$acta?->cliente?->nombre_completo ?? 'N/A'}}</label>
        </div>
    </div>

    <div class="mt-3">
        <b class="titulo">Puntos del Día:</b>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Punto</th>
                    <th>Descripción</th>
                    <th>Responsable</th>
                </tr>
            </thead>
            <tbody>
                @if (count($acta->puntosOrdenDiaActivos))
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($acta->puntosOrdenDiaActivos as $item)
                        <tr>
                            <td>{{$index++}}</td>
                            <td>{{$item?->titulo ?? 'N/A'}}</td>
                            <td>{{$item?->descripcion ?? 'N/A'}}</td>
                            <td>{{$item?->responsable?->nombre_completo ?? 'N/A'}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center">
                        <td colspan="4">No tiene puntos del día.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <b class="titulo">Acuerdos:</b>
        <p class="fs-5">{!! $acta?->acuerdos ?? '<b>Sin Acuerdos.</b>' !!}</p>
    </div>

    <div class="mt-3">
        <b class="titulo">Conclusión:</b>
        <p class="fs-5">{!! $acta?->conclusion ?? '<b>Sin Conclusión.</b>' !!}</p>
    </div>

    <div class="mt-3">
        <b class="titulo">Firma</b><br>
        @if ($acta?->responsable?->firma)
            <img src="{{ $acta?->responsable?->firma }}" width="200" height="150">
        @else
            <b>Sin firma.</b>
        @endif
        <br>
        <label class="fs-5"><b>Responsable:</b> {{$acta?->responsable?->nombre_completo ?? 'N/A'}}</label>
    </div>
@endsection
