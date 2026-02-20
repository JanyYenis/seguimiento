@foreach ($listado_archivos as $archivo)
    <div class="d-flex align-items-center position-relative mb-7">
        <div class="symbol symbol-75px mb-5">
            @if ($archivo?->mimeType == 'application/vnd.google-apps.folder')
                <img src="{{ asset('assets/media/svg/files/carpeta.svg') }}" class="theme-light-show" alt="">
                <img src="{{ asset('assets/media/svg/files/carpeta-dark.svg') }}" class="theme-dark-show" alt="">
            @elseif ($archivo?->mimeType == 'video/mp4')
                <img src="{{ asset('assets/media/svg/files/video.svg') }}" class="theme-light-show" alt="">
                <img src="{{ asset('assets/media/svg/files/video-dark.svg') }}" class="theme-dark-show" alt="">
            @elseif ($archivo?->mimeType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                <img src="{{ asset('assets/media/svg/files/word.svg') }}" class="theme-light-show" alt="">
                <img src="{{ asset('assets/media/svg/files/word.svg') }}" class="theme-dark-show" alt="">
            @elseif ($archivo?->mimeType == 'image/jpeg')
                <img src="{{ asset('assets/media/svg/files/archivo.svg') }}" class="theme-light-show" alt="">
                <img src="{{ asset('assets/media/svg/files/archivo-dark.svg') }}" class="theme-dark-show"
                    alt="">
            @elseif ($archivo?->mimeType == 'image/png')
                <img src="{{ asset('assets/media/svg/files/archivo.svg') }}" class="theme-light-show" alt="">
                <img src="{{ asset('assets/media/svg/files/archivo-dark.svg') }}" class="theme-dark-show"
                    alt="">
            @elseif ($archivo?->mimeType == 'image/jpg')
                <img src="{{ asset('assets/media/svg/files/archivo.svg') }}" class="theme-light-show" alt="">
                <img src="{{ asset('assets/media/svg/files/archivo-dark.svg') }}" class="theme-dark-show"
                    alt="">
            @elseif (
                $archivo?->mimeType == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||
                    $archivo?->mimeType == 'application/vnd.google-apps.spreadsheet')
                <img src="{{ asset('assets/media/svg/files/excel.svg') }}" class="theme-light-show" alt="">
                <img src="{{ asset('assets/media/svg/files/excel-dark.svg') }}" class="theme-dark-show" alt="">
            @elseif ($archivo?->mimeType == 'application/pdf')
                <img src="{{ asset('assets/media/svg/files/pdf.svg') }}" class="theme-light-show" alt="">
                <img src="{{ asset('assets/media/svg/files/pdf-dark.svg') }}" class="theme-dark-show" alt="">
                {{-- @elseif ($archivo?->mimeType == '') --}}
            @else
                <img src="{{ asset('assets/media/svg/files/archivo.svg') }}" class="theme-light-show" alt="">
                <img src="{{ asset('assets/media/svg/files/archivo-dark.svg') }}" class="theme-dark-show"
                    alt="">
            @endif
        </div>
        <div class="fw-semibold p-4">
            <a href="#" class="fs-3 fw-normal text-negro ">{{ $archivo?->name }}</a>
        </div>
    </div>
@endforeach