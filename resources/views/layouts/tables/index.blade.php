@extends('layouts.master')
@section('content')
    @push('css')
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/data-list-view.css">
    @endpush
    <div class="action-btns d-none">
        <div class="btn-dropdown mr-1 mb-1">
            <div class="btn-group dropdown actions-dropodown ml-2">
                <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions
                </button>
                <div class="dropdown-menu">
                    <a id="delete-params" type="button" class="dropdown-item action-delete"><i class="feather icon-trash-2"></i>Xoá</a>
                </div>
            </div>
        </div>
    </div>
    <section id="data-list-view" class="data-list-view-header">
        <div class="d-none">
            <div class="custom-control filter-on-off d-inline-block custom-switch ml-2 mb-1">
                <input type="checkbox" class="custom-control-input is-filter-grid" id="customSwitch80">
                Filter Version 2:
                <label class="custom-control-label" for="customSwitch80">
                    <span class="switch-text-left">On</span>
                    <span class="switch-text-right">Off</span>
                </label>
            </div>
        </div>
        <div class="table-responsive">
{{--            @widget('Filters')--}}
            <div class="filters d-none">
                <tr></tr>
            </div>
            {!! $dataTable->table() !!}
        </div>
        @include('layouts.tables.edit')
    </section>

    @push('js')
        {!! $dataTable->scripts() !!}
        <script>
            $(".select2").select2({
                maximumSelectionLength: 2
            });
            const URL_DELETE_API = "{{route($table.'.delete')}}";
            const URL_BUILD_CODE_ID = "{{route('build.code')}}";
            const TABLE_NAME = "{{$table}}";
            const TITLE_NAME = "{{$title}}";
            const INPUT_TYPE_SELECT = "{{json_encode(inputTypeSelect())}}";
            const TRANSACTION_LAYOUT = "{{json_encode(tableTransaction())}}";
            const URL_AUTO_COMPLETE = "{{route('reorders.autocomplete')}}";
            const URL_TAB_CREATE_REORDER = "{{route($table)}}"
        </script>
        <script src="../../../assets/js/custom/data-table-list.js"></script>
    @endpush
@endsection