<div class="modal fade" tabindex="-1" id="modalCrearMails">
    <form id="formCrearMails" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title">Mensaje nuevo</h1>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 btnCerrarModal" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="las la-times fs-1"></i>
                        </span>
                    </div>
                </div>

                <div class="modal-body scroll h-400px px-5">
                    <div id="errores">
                        @component('sistema/div-errores')
                        @endcomponent
                    </div>

                    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">

                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-body p-0">
                                <!--begin::Body-->
                                <div class="d-block">
                                    <!--begin::To-->
                                    <div class="d-flex align-items-center border-bottom px-8 min-h-50px">
                                        <!--begin::Label-->
                                        <div class="text-gray-900 fw-bold w-75px">
                                            Para:
                                        </div>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input class="form-control d-flex align-items-center" name="para" value=""
                                            placeholder="Para" id="tagify_users_para" />
                                        <!--end::Input-->

                                        <!--begin::CC & BCC buttons-->
                                        <div class="ms-auto w-75px text-end">
                                            <span class="text-muted fs-bold cursor-pointer text-hover-primary me-2"
                                                id="cc_button">CC</span>
                                            <span class="text-muted fs-bold cursor-pointer text-hover-primary"
                                                id="cco_button">CCO</span>
                                        </div>
                                        <!--end::CC & BCC buttons-->
                                    </div>
                                    <!--end::To-->

                                    <!--begin::CC-->
                                    <div class="d-none align-items-center border-bottom px-8 min-h-50px" id="cc_seccion">
                                        <!--begin::Label-->
                                        <div class="text-gray-900 fw-bold w-75px">
                                            CC:
                                        </div>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input class="form-control d-flex align-items-center" name="cc" value=""
                                            placeholder="CC" id="inputCC" />
                                        <!--end::Input-->

                                        <!--begin::Close-->
                                        <span class="btn btn-clean btn-xs btn-icon" data-kt-inbox-form="cc_close">
                                            <i class="las la-times fs-5"></i> </span>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::CC-->

                                    <!--begin::BCC-->
                                    <div class="d-none align-items-center border-bottom inbox-to-bcc ps-8 pe-5 min-h-50px"
                                        id="cco_seccion">
                                        <!--begin::Label-->
                                        <div class="text-gray-900 fw-bold w-75px">
                                            CCO:
                                        </div>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text"
                                            class="form-control d-flex align-items-center" name="cco"
                                            value="" id="inputCCO" tabindex="-1">
                                        <!--end::Input-->

                                        <!--begin::Close-->
                                        <span class="btn btn-clean btn-xs btn-icon" data-kt-inbox-form="cco_close">
                                            <i class="las la-times fs-5"></i>
                                        </span>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::BCC-->

                                    <!--begin::Subject-->
                                    <div class="border-bottom">
                                        <input class="form-control form-control-transparent border-0 px-8 min-h-45px"
                                            name="asunto" placeholder="Asunto">
                                    </div>
                                    <!--end::Subject-->

                                    <div id="kt_docs_quill_basic" name="kt_docs_quill_basic" style="height: 150px;"></div>
                                    <!--end::Body-->
                                </div>
                            </div>
                            <!--end::Card-->

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary-gijac">Enviar</button>
                    </div>
                </div>
            </div>
    </form>
</div>
