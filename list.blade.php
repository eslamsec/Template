@extends('theme.main')

@section('title', translate('Booking Type List'))
@section('css')
    <script type="text/javascript" src="{{ asset(main_path() . 'js/bootstrap-multiselect.js') }}"></script>
    <link rel="stylesheet" href="{{ asset(main_path() . 'css/bootstrap-multiselect.css') }}" type="text/css" />
    <script src="{{ asset(main_path() . 'js/bootstrap3-typeahead.js') }}"></script>
    <script src="{{ asset(main_path() . 'asset/room-reservation/js.js') }}"></script>
    <link href="{{ asset(main_path() . 'asset/room-reservation/style.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


    <div class="content">
        <div class="container-fluid">

            <div class="page-title-box">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="page-title ml-2">{{ translate('Booking Types') }}</h4>
                    </div>

                    <div class="col-md-9">
                        <div class="page-title-right">
                            <div class="titlemenu">
                                <a class="btn btn-primary" data-module="booking_types" data-table="#booking_types_table"
                                    onclick="form_modal(this)" data-fields='["name","code"]'
                                    data-route-store="{{ route('booking_type.store') }}"
                                    data-route-form="{{ route('booking_type.form') }}"
                                    data-route-edit="{{ route('booking_type.edit', ':id') }}"
                                    data-route-update="{{ route('booking_type.update', ':id') }}"><i class="icon-plus"></i>
                                    {{ translate('Add New') }}</a>
                                <a class="btn btn-primary show_all_btn" data-val="1" onclick="list_all(this)">
                                    <i class="fa fa-list"></i> {{ translate('Show All') }}
                                </a>
                                <a href="#" class="btn btn-primary" data-url="{{ route('booking_type.search_form') }}"
                                    data-title="Search" data-modalwidth="50" onclick="return search_form(this)"
                                    data-route="{{ route('booking_type.search_results') }}">
                                    <i class="ti-search"></i>{{ translate('Search') }}
                                </a>
                                <a href="#" class="btn btn-primary clearsearch d-none"
                                    style=" background-color: #ff5d48; border-color: #ff5d48;"
                                    data-url="{{ route('booking_type.table') }}" onclick="return clear_search(this)">
                                    <i class="icon-plus"></i> {{ translate('Clear Search') }}
                                </a>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card-box ajax-wrapper" id="booking_types_table_wrapper" data-wrapper="booking_types_table_wrapper">
                        @include('room_master.booking_type.table')
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
   



@endsection
