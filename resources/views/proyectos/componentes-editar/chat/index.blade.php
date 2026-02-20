
    {{-- <div class="d-flex flex-column flex-lg-row">
        <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
            <div class="card card-flush h-100">
                <div class="card-header pt-7" id="kt_chat_contacts_header">
                    <form class="w-100 position-relative" autocomplete="off">
                        <i class="fas fa-search fs-3 text-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>

                        <input type="text" class="form-control form-control-solid px-13" name="search" value=""
                            placeholder="Buscar por nombre o email">
                    </form>
                </div>
                <div class="card-body mt-2 bg-ligth" id="kt_chat_contacts_body">
                    <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header"
                        data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body"
                        data-kt-scroll-offset="5px" style="max-height: 480px;">

                        <div class="seccionContactos">
                            @component('proyectos.componentes-editar.chat.contactos')
                                @slot('usuarios', $usuarios)
                            @endcomponent
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}

        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
            <!--begin::Messenger-->
            <div class="card" id="kt_chat_messenger" style="height: 100%;">
                <div class="seccionChat p-3">
                    <div class="text-center p-4">
                        <!--begin::Card header-->
                            <div class="card-header" id="kt_chat_messenger_header">
                                <!--begin::Title-->
                                <div class="card-title">
                                    <!--begin::User-->
                                    <div class="d-flex justify-content-center flex-column mt-2">
                                        <div class="symbol symbol-35px symbol-circle d-flex align-items-center ">
                                            @if ($proyecto?->logo)
                                                <img src="{{ $proyecto?->logo ? asset($proyecto?->logo) : asset('assets/media/avatars/150-2.jpg')}}" alt="metronic" />
                                            @else
                                                <span class="symbol-label bg-light-info text-info fs-5 fw-normal">{{$proyecto->nombre[0]}}</span>
                                            @endif
                                            <a href="#" class="fs-3 fw-normal text-gray-900 me-1 mb-2 lh-1 ms-3">
                                                {{$proyecto->nombre}}
                                            </a>
                                        </div>
                                        <div class="mb-0 mt-2 lh-1 mt-3 mb-4">
                                            {{-- <span class="badge badge-danger badge-circle w-10px h-10px me-1 iconEstado"></span> --}}
                                            {{-- <span class="fs-5 fw-semibold text-muted textoEstado">Inactivo</span><br> --}}
                                            <span class="fs-5 fw-semibold text-muted textoEscribiendo fst-italic d-none">Escribiendo...</span>
                                        </div>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                                <div class="d-flex align-items-center">
                                    {{-- <button class="btn btn-sm btn-icon btn-active-light-primary me-2">
                                        <i class="fas fa-video fs-1"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-active-light-primary me-2">
                                        <i class="fas fa-phone-alt fs-1"></i>
                                    </button> --}}
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body" id="kt_chat_messenger_body" style="height: 36.5rem;">
                                <!--begin::Messages-->
                                <div id="espacioChat" class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages" data-kt-scroll="true"
                                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                                    data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                                    data-kt-scroll-offset="5px" style="max-height: 428px;">

                                    <div class="seccionchat p-3">
                                        {{-- @component('chat.mensaje')
                                            @slot('mensajes', $mensajes)
                                        @endcomponent --}}
                                    </div>
                                </div>
                                <!--end::Messages-->
                            </div>
                            <!--end::Card body-->

                            <!--begin::Card footer-->
                            <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                <form id="formMensaje" enctype="multipart/form-data">
                                    <input type="hidden" id="idProyecto" name="idProyecto" value="{{$proyecto->id}}">
                                    <input type="file" id="idArchivo" name="archivo" class="d-none">
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-flush mb-3 rounded" id="inputMensaje" name="mensaje" rows="1" placeholder="Mensaje"></textarea>
                                    <!--end::Input-->

                                    <!--begin:Toolbar-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center">
                                            {{-- <!--begin::Menu wrapper-->
                                            <div>
                                                <button type="button" class="btn btn-sm btn-icon me-1" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="30px, 30px">
                                                    <i class="fas fa-paperclip fs-3"></i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-300 mw-300px" data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modalCapturarFoto">
                                                            <i class="fas fa-camera fs-4"></i>
                                                            Camara
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 btnGaleria">
                                                            <i class="far fa-image fs-3 me-2 text-info"></i>
                                                            Galeria
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">
                                                            <i class="fas fa-headphones-alt fs-3 me-2 text-warning"></i>
                                                            Audio
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Dropdown wrapper--> --}}
                                            <button class="btn btn-sm btn-camara" type="button" data-bs-toggle="modal" data-bs-target="#modalCapturarFoto">
                                                <i class="fas fa-camera fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        </div>
                                        <!--end::Actions-->

                                        <div class="">
                                            <!--begin::Send-->
                                            <button class="btn btn-enviar-icono d-flex p-4" type="submit">
                                                <i class="far fa-paper-plane fs-3 text-white"></i>
                                            </button>
                                            {{-- <button class="btn btn-primary-gijac" type="button">
                                                <i class="fas fa-microphone fs-3 text-white"></i>
                                            </button> --}}
                                            <!--end::Send-->
                                        </div>
                                    </div>
                                </form>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card footer-->
                        {{-- <img src="{{ asset('img/phone.svg') }}" width="60%"> --}}
                    </div>
                </div>
            </div>
            <!--end::Messenger-->
        </div>
        <!--end::Content-->


