@extends('pdfs.index', ['titulo' => 'CUENTA DE COBRO'])

@section('content')
    <div class="text-start">
        <label class="fs-6">Santiago de Cali, {{$cuenta->fecha->format('d/m/Y')}}</label>
    </div>

    <div class="text-center mt-3">
        <b class="text-primary-gijac" style="font-size: 2.5rem;">CUENTA DE COBRO</b>
    </div>

    <div class="text-center mt-4">
        <b class="fs-6">{{$cuenta?->proyecto?->cliente?->nombre_completo ?? 'N/A'}}</b><br>
        <label class="fs-6">{{$cuenta?->proyecto?->cliente?->infoDocumento?->nombre_corto ?? 'N/A'}} {{formatearNitPorPais($cuenta?->proyecto?->cliente?->identificacion ?? 0)}}</label>
    </div>

    <div class="text-center mt-3">
        <label class="fs-6">DEBE A:</label>
    </div>

    <div class="text-center mt-3">
        <b class="fs-6">{{$cuenta?->remitente?->nombre_completo ?? 'N/A'}}</b><br>
        <label class="fs-6">{{$cuenta?->remitente?->infoDocumento?->nombre_corto ?? 'N/A'}} {{formatoMiles($cuenta?->remitente?->identificacion ?? 0)}}</label>
    </div>

    <div class="mt-3">
        <p class="fs-6">La suma de: <b>{{numeroALetras($cuenta?->valor ?? 0)}}</b> pesos COP <b>(${{ formatoMiles($cuenta?->valor ?? 0) }})</b></p>
        <p class="fs-6"><b>Por objeto de:</b></p>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción del Servicio</th>
                    <th>Cantidad</th>
                    <th>Valor Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @if (count($cuenta?->serviciosActivos))
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($cuenta?->serviciosActivos as $item)
                        <tr>
                            <td>{{$index++}}</td>
                            <td>{{$item?->fase?->titulo ?? 'N/A'}}</td>
                            <td>{{$item?->cantidad ?? 1}}</td>
                            <td>${{formatoMiles($item?->valor ?? 0)}}</td>
                            <td>${{formatoMiles((($item?->valor ?? 0) * ($item?->cantidad ?? 1)) ?? 0)}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center">
                        <td colspan="4">No tiene servicios.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <p class="mt-2 fs-6">El pago deberá ser consignado en la cuenta de ahorros <b>N°. {{ formatoMiles($cuenta?->numero_cuenta?? 0) }}</b> del Banco <b>{{ $cuenta?->banco ?? 'N/A' }}</b>.</p>
    </div>

    <div class="mt-3">
        <b class="titulo">Firma</b><br>
        @if ($cuenta?->remitente?->firma)
            <img src="{{ $cuenta?->remitente?->firma }}" width="200" height="150">
        @else
            <b>Sin firma.</b>
        @endif
        <br>
        <label class="fs-5"><b>Remitente:</b> {{$cuenta?->remitente?->nombre_completo ?? 'N/A'}}</label><br>
        <label class="fs-5"><b>{{$cuenta?->remitente?->infoDocumento?->nombre_corto ?? 'N/A'}}:</b> {{formatoMiles($cuenta?->remitente?->identificacion ?? 0)}}</label>
    </div>
@endsection
