@extends('layouts.index', ['title' => 'Calendario'])

@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-column flex-lg-row-auto w-100 mb-10 mb-lg-0">
            <div class="card card-flush">
                <div class="card-body pt-5" id="kt_chat_contacts_body">
                    <div id="kt_calendar"></div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    @component('calendario.modals')
    @endcomponent
@endsection

@section('scripts')
    <script src="{{ mix('/js/calendario/principal.js') }}" ></script>
@endsection