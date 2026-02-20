@php
    $mensajes = $mensajes ?? [];
    $usuario = auth()->user();
@endphp
@foreach ($mensajes as $mensaje)
    @if ($mensaje->de == $usuario->id)
        <!--begin::Message(out)-->
        <div class="d-flex justify-content-end mb-10 ">
            <div class="d-flex flex-column align-items-end">
                <div class="d-flex align-items-center mb-2">
                    <div class="me-3">
                        <span class="text-muted fs-7 mb-1">{{$mensaje->created_at}}</span>
                        <a href="#" class="fs-3 fw-normal text-gray-900 ms-1">Tu</a>
                    </div>
                    <div class="symbol symbol-35px symbol-circle ">
                        @if ($usuario?->foto)
                            <img src="{{ $usuario?->foto ? asset($usuario?->foto) : asset('assets/media/avatars/150-2.jpg')}}" alt="metronic" />
                        @else
                            <span class="symbol-label bg-light-info text-info fs-6 fw-bolder">{{$usuario->nombre[0]}}</span>
                        @endif
                    </div>
                </div>
                <div class="p-5 rounded bg-fondo-chat-g shadow-sm text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">
                    @if ($mensaje->es_imagen)
                        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{ $mensaje?->multimedia ? asset($mensaje?->multimedia) : asset('assets/media/avatars/150-2.jpg')}}">
                            {{-- <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                style="background-image:url({{ $mensaje?->multimedia ? asset($mensaje?->multimedia) : asset('assets/media/avatars/150-2.jpg')}})">
                            </div> --}}
                            <img src="{{ $mensaje?->multimedia ? asset($mensaje?->multimedia) : asset('assets/media/avatars/150-2.jpg')}}" alt="metronic" style="max-width: 100%; min-width: 100%; border-radius: 2%"/>
                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                <i class="far fa-eye text-white fs-3x"></i>
                            </div>
                        </a>
                    @endif
                    <div class="mt-2 size-mensaje text-chat">
                        {{ $mensaje->contenido }}
                    </div>
                    <div class="d-flex justify-content-end">
                        @if ($mensaje->estado == 1)
                            <i class="las la-check"></i>
                        @else
                            <i class="las la-check-double text-primary"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--end::Message(out)-->
    @else
        <!--begin::Message(in)-->
        <div class="d-flex justify-content-start mb-10 ">
            <div class="d-flex flex-column align-items-start">
                <div class="d-flex align-items-center mb-2">
                    <div class="symbol symbol-35px symbol-circle">
                        @if ($mensaje?->deU?->foto)
                            <img src="{{ $mensaje?->deU?->foto ? asset($mensaje?->deU?->foto) : asset('assets/media/avatars/150-2.jpg')}}" alt="metronic" />
                        @else
                            <span class="symbol-label bg-light-info text-info fs-6 fw-bolder">{{$mensaje?->deU->nombre[0]}}</span>
                        @endif
                    </div>
                    <div class="ms-3">
                        <a href="#" class="fs-3 fw-normal text-gray-900 text-hover-primary me-1">{{$mensaje->deU->nombre_completo}}</a>
                        <span class="text-muted fs-7 mb-1">{{$mensaje->created_at}}</span>
                    </div>
                </div>
                <div class="p-5 rounded bg-fondo-chat shadow-sm text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">
                    @if ($mensaje->es_imagen)
                        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{ $mensaje?->multimedia ? asset($mensaje?->multimedia) : asset('assets/media/avatars/150-2.jpg')}}">
                            {{-- <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                style="background-image:url({{ $mensaje?->multimedia ? asset($mensaje?->multimedia) : asset('assets/media/avatars/150-2.jpg')}})">
                            </div> --}}
                            <img src="{{ $mensaje?->multimedia ? asset($mensaje?->multimedia) : asset('assets/media/avatars/150-2.jpg')}}" alt="metronic" style="max-width: 100%; min-width: 100%; border-radius: 2%"/>
                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                <i class="far fa-eye text-white fs-3x"></i>
                            </div>
                        </a>
                    @endif
                    <div class="mt-2 size-mensaje text-chat">
                        {{ $mensaje->contenido }}
                    </div>
                    <div class="d-flex justify-content-end">
                        @if ($mensaje->estado == 1)
                            <i class="las la-check"></i>
                        @else
                            <i class="las la-check-double text-primary"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--end::Message(in)-->
    @endif
@endforeach