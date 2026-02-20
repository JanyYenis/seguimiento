<div class="">
    <div class="text-start mb-5">
        <div class="seccionBe"></div>
    </div>
    @canany(['archivos.crear'])
        <div class="text-end mb-5">
            <a href="#" class="btn btn-archivo ms-3 px-4 py-3"
                data-bs-toggle="modal" data-bs-target="#modalCargarArchivo">
                <i class="las la-cloud-upload-alt icono-color fs-4 mb-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <span>Cargar Archivo</span>
            </a>
        </div>
    @endcanany
</div>
<div class="seccionArchivos"></div>