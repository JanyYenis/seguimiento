<a href="#" class="d-flex align-items-center text-gray-900">
    <!--begin::Avatar-->
    <div class="symbol symbol-35px me-3">
        <div class="symbol-label bg-light-danger">
            <span class="text-succes">{{$nombre[0]}}</span>
        </div>
    </div>
    <!--end::Avatar-->

    <!--begin::Name-->
    <span class="fw-semibold {{ $isRead ? 'text-gray-400' : 'text-dark' }}">{{ $nombre }}</span>
    <!--end::Name-->
</a>
