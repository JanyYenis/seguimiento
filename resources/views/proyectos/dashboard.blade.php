@extends('layouts.index', ['titulo' => 'Proyectos', 'nombre_titulo' => 'Proyectos'])

@section('btns')
    @canany(['proyectos.crear'])
        <button type="button" class="btn btn-primary-gijac" data-bs-toggle="modal" data-bs-target="#modalCrearProyectos">
            Crear Nuevo Proyecto
        </button>
    @endcanany
@endsection

@section('content')
    <div class="row gx-6 gx-xl-9">
        <div class="col-xl-4 mb-10">

            <!--begin::Lists Widget 19-->
            <div class="card card-flush h-xl-100">
                <!--begin::Heading-->
                <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                    style="background-image:url('{{ asset('assets/media/svg/shapes/top-green.png') }}')"
                    data-bs-theme="light">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column text-white pt-15">
                        <span class="fw-bold fs-2x mb-3">Mis proyectos</span>

                        <div class="fs-4 text-white">
                            <span class="opacity-75">Tienes</span>

                            <span class="position-relative d-inline-block">
                                <a href="{{ route('proyectos.index') }}"
                                    class="link-white opacity-75-hover fw-bold d-block mb-1">{{ $cantidad_total }} proyectos</a>

                                <!--begin::Separator-->
                                <span
                                    class="position-absolute opacity-50 bottom-0 start-0 border-2 border-body border-bottom w-100"></span>
                                <!--end::Separator-->
                            </span>
                        </div>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->

                <!--begin::Body-->
                <div class="card-body mt-n20">
                    <!--begin::Stats-->
                    <div class="mt-n20 position-relative">
                        <!--begin::Row-->
                        <div class="row g-3 g-lg-6">
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <i class="ki-outline ki-flask fs-1 text-primary"></i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{$cantidad_completados ?? 0}}</span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">Completados</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <i class="ki-outline ki-bank fs-1 text-primary"></i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $cantidad_ejecucion ?? 0 }}</span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">En progreso</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <i class="ki-outline ki-award fs-1 text-primary"></i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{$cantidad_pendientes ?? 0}}</span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">Pendientes</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <i class="ki-outline ki-timer fs-1 text-primary"></i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">822</span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">Hours Learned</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Lists Widget 19-->
        </div>
        {{-- <div class="col-lg-4 col-xxl-4">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Heading-->
                    <h1 class="fs-2hx fw-bold ">Proyectos actualizados</h1>
                    <div class="fs-2hx fw-bold texto-azul">{{ $cantidad_total ?? 0 }}</div>
                    <!--end::Heading-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-wrap">
                        <!--begin::Chart-->
                        <div class="d-flex flex-center h-100px w-100px me-9 mb-5">
                            <canvas id="kt_project_list_chart"
                                style="display: block; box-sizing: border-box; height: 100px; width: 100px;" width="100"
                                height="100"></canvas>
                        </div>
                        <!--end::Chart-->

                        <!--begin::Labels-->
                        <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                            <!--begin::Label-->
                            <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                <div class="bullet bg-primary me-3"></div>
                                <div class="text-gray-500">Pendiente</div>
                                <div class="ms-auto fw-bold text-gray-700">{{ $cantidad_pendientes ?? 0 }}</div>
                            </div>
                            <!--end::Label-->

                            <!--begin::Label-->
                            <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                <div class="bullet bg-warning me-3"></div>
                                <div class="text-gray-500">En proceso</div>
                                <div class="ms-auto fw-bold text-gray-700">{{ $cantidad_ejecucion ?? 0 }}</div>
                            </div>
                            <!--end::Label-->

                            <!--begin::Label-->
                            <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                <div class="bullet bg-success me-3"></div>
                                <div class="text-gray-500">Completado</div>
                                <div class="ms-auto fw-bold text-gray-700">{{ $cantidad_completados ?? 0 }}</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Labels-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div> --}}

        <div class="col-lg-8 col-xl-8 col-xxl-9 mb-10 mb-xl-0 mt-3">
            <!--begin::Timeline widget 3-->
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">What’s up Today</span>

                        <span class="text-muted mt-1 fw-semibold fs-7">Total 424,567 deliveries</span>
                    </h3>

                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-sm btn-light">Report Cecnter</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body pt-7 px-0">
                    <!--begin::Nav-->
                    <ul class="nav nav-stretch nav-pills nav-pills-custom nav-pills-active-custom d-flex justify-content-between mb-8 px-5"
                        role="tablist">
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_1" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">Fr</span>
                                <span class="fs-6 fw-bold">20</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_2" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">Sa</span>
                                <span class="fs-6 fw-bold">21</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_3" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">Su</span>
                                <span class="fs-6 fw-bold">22</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger active"
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_4" aria-selected="true"
                                role="tab">
                                <span class="fs-7 fw-semibold">Tu</span>
                                <span class="fs-6 fw-bold">23</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_5" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">Tu</span>
                                <span class="fs-6 fw-bold">24</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_6" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">We</span>
                                <span class="fs-6 fw-bold">25</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_7" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">Th</span>
                                <span class="fs-6 fw-bold">26</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_8" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">Fri</span>
                                <span class="fs-6 fw-bold">27</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_9" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">Sa</span>
                                <span class="fs-6 fw-bold">28</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_10" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">Su</span>
                                <span class="fs-6 fw-bold">29</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item p-0 ms-0" role="presentation">
                            <!--begin::Date-->
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger "
                                data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_11" aria-selected="false"
                                tabindex="-1" role="tab">
                                <span class="fs-7 fw-semibold">Mo</span>
                                <span class="fs-6 fw-bold">30</span>
                            </a>
                            <!--end::Date-->
                        </li>
                        <!--end::Nav item-->

                    </ul>
                    <!--end::Nav-->

                    <!--begin::Tab Content (ishlamayabdi)-->
                    <div class="tab-content mb-2 px-9">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_1" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Dashboard UI/UX Design Review </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_2" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_3" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_timeline_widget_3_tab_content_4" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Dashboard UI/UX Design Review </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_5" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Dashboard UI/UX Design Review </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_6" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Dashboard UI/UX Design Review </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_7" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Dashboard UI/UX Design Review </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_8" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Dashboard UI/UX Design Review </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_9" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Dashboard UI/UX Design Review </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_10" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Dashboard UI/UX Design Review </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_11" role="tabpanel">

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        16:30 - 17:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            PM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Dashboard UI/UX Design Review </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                            Morris</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        10:20 - 11:00
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        Marketing Campaign Discussion </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                            Marcus</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>
                                <!--end::Bullet-->

                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-2">
                                        12:00 - 13:40
                                        <span class="text-gray-500 fw-semibold fs-7">
                                            AM </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6">
                                        9 Degree Project Estimation Meeting </div>
                                    <!--end::Description-->

                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">
                                        Lead by
                                        <!--begin::Name-->
                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                            Bob</a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tap pane-->

                    </div>
                    <!--end::Tab Content-->

                    <!--begin::Action-->
                    <div class="float-end d-none">
                        <a href="#" class="btn btn-sm btn-light me-2" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_create_project">Add Lesson</a>

                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_create_app">Call Sick for Today</a>
                    </div>
                    <!--end::Action-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Timeline widget 3-->




            <!--begin::Timeline widget 3-->
            <div class="card card-flush d-none h-md-100">
                <!--begin::Card header-->
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title flex-column">
                        <h3 class="fw-bold mb-1">What's on the road?</h3>

                        <div class="fs-6 text-gray-500">Total 482 participants</div>
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Select-->
                        <select name="status" data-control="select2" data-hide-search="true"
                            class="form-select form-select-solid form-select-sm fw-bold w-100px select2-hidden-accessible"
                            data-select2-id="select2-data-1-srw7" tabindex="-1" aria-hidden="true"
                            data-kt-initialized="1">
                            <option value="1" selected="" data-select2-id="select2-data-3-plsi">Options</option>
                            <option value="2">Option 1</option>
                            <option value="3">Option 2</option>
                            <option value="4">Option 3</option>
                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr"
                            data-select2-id="select2-data-2-4y6p" style="width: 100%;"><span class="selection"><span
                                    class="select2-selection select2-selection--single form-select form-select-solid form-select-sm fw-bold w-100px"
                                    role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                    aria-disabled="false" aria-labelledby="select2-status-hk-container"
                                    aria-controls="select2-status-hk-container"><span class="select2-selection__rendered"
                                        id="select2-status-hk-container" role="textbox" aria-readonly="true"
                                        title="Options">Options</span><span class="select2-selection__arrow"
                                        role="presentation"><b role="presentation"></b></span></span></span><span
                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                        <!--end::Select-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body p-0">
                    <!--begin::Dates-->
                    <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2 ms-4" role="tablist">

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_0" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Fr</span>
                                <span class="fs-6 text-gray-800 fw-bold">20</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_1" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Sa</span>
                                <span class="fs-6 text-gray-800 fw-bold">21</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_2" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Su</span>
                                <span class="fs-6 text-gray-800 fw-bold">22</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger active"
                                data-bs-toggle="tab" href="#kt_schedule_day_3" aria-selected="true" role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Mo</span>
                                <span class="fs-6 text-gray-800 fw-bold">23</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_4" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Tu</span>
                                <span class="fs-6 text-gray-800 fw-bold">24</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_5" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">We</span>
                                <span class="fs-6 text-gray-800 fw-bold">25</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_6" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Th</span>
                                <span class="fs-6 text-gray-800 fw-bold">26</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_7" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Fr</span>
                                <span class="fs-6 text-gray-800 fw-bold">27</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_8" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Sa</span>
                                <span class="fs-6 text-gray-800 fw-bold">28</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_9" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Su</span>
                                <span class="fs-6 text-gray-800 fw-bold">29</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_10" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Mo</span>
                                <span class="fs-6 text-gray-800 fw-bold">30</span>
                            </a>
                        </li>
                        <!--end::Date-->

                        <!--begin::Date-->
                        <li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger "
                                data-bs-toggle="tab" href="#kt_schedule_day_11" aria-selected="false" tabindex="-1"
                                role="tab">

                                <span class="text-gray-500 fs-7 fw-semibold">Tu</span>
                                <span class="fs-6 text-gray-800 fw-bold">31</span>
                            </a>
                        </li>
                        <!--end::Date-->
                    </ul>
                    <!--end::Dates-->

                    <!--begin::Tab Content-->
                    <div class="tab-content px-9">
                        <!--begin::Day-->
                        <div id="kt_schedule_day_0" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        16:30 - 17:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Sales Pitch Proposal </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Bob Harris</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Creative Content Initiative </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Karina Clarke</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        11:00 - 11:45

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Dashboard UI/UX Design Review </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Peter Marcus</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_1" class="tab-pane fade show active" role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        11:00 - 11:45

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Weekly Team Stand-Up </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Mark Randall</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        13:00 - 14:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Dashboard UI/UX Design Review </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Bob Harris</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        13:00 - 14:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Marketing Campaign Discussion </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Terry Robins</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_2" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        13:00 - 14:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Project Review &amp; Testing </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Mark Randall</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Development Team Capacity Review </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Peter Marcus</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        16:30 - 17:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Committee Review Approvals </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">David Stevenson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_3" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Creative Content Initiative </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Walter White</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        11:00 - 11:45

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Weekly Team Stand-Up </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Naomi Hayabusa</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        9 Degree Project Estimation Meeting </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Peter Marcus</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_4" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        11:00 - 11:45

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Creative Content Initiative </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Michael Walters</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        13:00 - 14:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Project Review &amp; Testing </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">David Stevenson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Development Team Capacity Review </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Caleb Donaldson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_5" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        11:00 - 11:45

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Sales Pitch Proposal </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Terry Robins</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        11:00 - 11:45

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Team Backlog Grooming Session </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Mark Randall</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Development Team Capacity Review </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">David Stevenson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_6" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        12:00 - 13:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Marketing Campaign Discussion </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Naomi Hayabusa</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Dashboard UI/UX Design Review </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">David Stevenson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        13:00 - 14:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Committee Review Approvals </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Naomi Hayabusa</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_7" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        14:30 - 15:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Lunch &amp; Learn Catch Up </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Naomi Hayabusa</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        14:30 - 15:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Team Backlog Grooming Session </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">David Stevenson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        9 Degree Project Estimation Meeting </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Mark Randall</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_8" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        11:00 - 11:45

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Committee Review Approvals </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Sean Bean</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        11:00 - 11:45

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Dashboard UI/UX Design Review </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Caleb Donaldson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Lunch &amp; Learn Catch Up </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Yannis Gloverson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_9" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        14:30 - 15:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Creative Content Initiative </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Kendell Trevor</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        16:30 - 17:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Creative Content Initiative </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Mark Randall</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        14:30 - 15:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Creative Content Initiative </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Caleb Donaldson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_10" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        14:30 - 15:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Marketing Campaign Discussion </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Kendell Trevor</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        14:30 - 15:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Creative Content Initiative </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Peter Marcus</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        13:00 - 14:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        9 Degree Project Estimation Meeting </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Caleb Donaldson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_11" class="tab-pane fade show " role="tabpanel">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        14:30 - 15:30

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            pm </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        Weekly Team Stand-Up </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Kendell Trevor</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        9 Degree Project Estimation Meeting </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Yannis Gloverson</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->

                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">
                                        9:00 - 10:00

                                        <span class="fs-7 text-gray-500 text-uppercase">
                                            am </span>
                                    </div>
                                    <!--end::Time-->

                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        9 Degree Project Estimation Meeting </a>
                                    <!--end::Title-->

                                    <!--begin::User-->
                                    <div class="text-gray-500">
                                        Lead by <a href="#">Walter White</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Timeline widget-3-->
        </div>
    </div>
@endsection

@section('modal')
    @component('proyectos.crear')
        @slot('responsables', $responsables)
        @slot('clientes', $clientes)
    @endcomponent
@endsection

@section('scripts')
    <script src="{{ mix('/js/proyectos/dashboard.js') }}"></script>
@endsection
