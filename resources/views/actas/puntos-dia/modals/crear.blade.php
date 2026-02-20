<div class="modal fade" tabindex="-1" id="modalCrearPunto">
    <form id="formCrearPunto">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title">Crear Punto del Día</h1>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                        <i class="las la-times fs-1"></i>
                    </span>
                    </div>
                </div>

                <div class="modal-body">
                    <div id="errores">
                        @component('sistema/div-errores')
                        @endcomponent
                    </div>
                    <input type="hidden" name="cod_acta" value="{{ $acta?->id }}">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-7">
                            <label class="required fs-5">Orden</label>
                            <input type="number" min="1" name="numero" class="form-control" placeholder="Ingrese el orden del punto de la reunion" required>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-7">
                            <label class="required fs-5">Punto</label>
                            <input type="text" name="titulo" class="form-control" placeholder="Ingrese el punto de la reunion" required>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-7">
                            <label class="required fs-5">Responsable</label>
                            <select name="cod_responsable" id="selectResponsable" data-control="select2" data-placeholder="Seleccione el responsable" data-allow-clear="true" class="form-control" required data-dropdown-parent="body">
                                <option value=""></option>
                                @foreach ($responsables as $item)
                                    <option value="{{$item->id}}">{{$item->nombre_completo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-7">
                            <label class="fs-5">Descripción</label>
                            <textarea name="descripcion" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary-gijac">Crear</button>
                </div>
            </div>
        </div>
    </form>
</div>
