@php
    $servicio = $servicio ?? null;
@endphp
<input type="hidden" name="id" value="{{$servicio->id}}">
<input type="hidden" name="cod_cuenta" value="{{$servicio->cod_cuenta}}">
<div id="errores">
    @component('sistema/div-errores')
    @endcomponent
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 mb-7">
        <label class="required fs-5">Servicios</label>
        <select name="cod_fase" id="selectServiciosEdit" class="form-control" data-control="select2" data-placeholder="Seleccione el servicio" data-allow-clear="true" required>
            <option value=""></option>
            @foreach ($fases as $item)
                <option value="{{ $item?->id }}" {{ $item?->id == $servicio?->cod_fase ? 'selected' : '' }}>{{$item?->text}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 col-md-6 mb-7">
        <label class="required fs-5">Valor Unitario</label>
        <div class="input-group w-md-300px"
            data-kt-dialer="true"
            data-kt-dialer-currency="true"
            data-kt-dialer-min="1000"
            data-kt-dialer-max="5000000"
            data-kt-dialer-step="10000"
            data-kt-dialer-prefix="$">

            <!--begin::Decrease control-->
            <button class="btn btn-icon btn-outline btn-active-color-primary" type="button" data-kt-dialer-control="decrease">
                <i class="fas fa-minus fs-2"></i>
            </button>
            <!--end::Decrease control-->

            <!--begin::Input control-->
            <input type="text" class="form-control" name="valor" required placeholder="Valor unitario" value="${{ $servicio?->valor ?? 0 }}" data-kt-dialer-control="input"/>
            <!--end::Input control-->

            <!--begin::Increase control-->
            <button class="btn btn-icon btn-outline btn-active-color-primary" type="button" data-kt-dialer-control="increase">
                <i class="fas fa-plus fs-2"></i>
            </button>
            <!--end::Increase control-->
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-6 col-md-6">
        <label class="required fs-5">Cantidad</label>
        <input type="number" name="cantidad" min="1" minlength="1" value="{{ $servicio?->cantidad ?? 1 }}" required class="form-control" placeholder="Ingrese la cantidad">
    </div>
</div>
</div>
