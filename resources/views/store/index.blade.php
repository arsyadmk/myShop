@extends('layout')

{{-- Customize layout sections --}}

@section('subtitle', 'Store')
@section('content_header_title', 'Store')
@section('plugins.Datatables', true)

{{-- Content body: main page content --}}

@section('content_body')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}

    @if (session('success'))
        <x-adminlte-alert class="auto-close-alert" theme="success" title="Success" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    {{-- Setup data for datatables --}}
    @php
        // dd($stores);
        $heads = ['', 'Name', 'Type', 'Create', ['label' => 'Actions', 'no-export' => true]];

        $btnEdit = '';
        $btnDelete = '';
        $btnDetail = '';

        $store_temp = [];
        foreach ($stores as $key => $store) {
            // dd($store->created_at->diffForHumans());
            $btnEdit =
                '<a href="stores/manage/' .
                $store->id .
                '"><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></button></a>';
            $btnDelete =
                '<a href="stores/manage/delete/' .
                $store->id .
                '" onclick="return confirm(\'Are you sure you want to delete this store?\')"><button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"><i class="fa fa-lg fa-fw fa-trash"></i></button></a>';
            $store_name_temp = '';
            if ($store->store) {
                $store_name_temp = $store->store->name;
            }
            $store_temp[] = [
                $key + 1,
                $store->name,
                store_type($store->type),
                $store->created_at->diffForHumans(),
                '<nobr>' . $btnEdit . $btnDelete . '</nobr>',
            ];
        }
        $config = [
            'data' => $store_temp,
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false]],
        ];
        // dd($config_bu['data'], $config['data']);

        function store_type($value)
        {
            if ($value == 0) {
                return 'Pusat';
            } elseif ($value == 1) {
                return 'Cabang';
            } elseif ($value == 2) {
                return 'Retail';
            } else {
                return 'Error';
            }
        }
    @endphp

    {{-- Themes --}}
    <x-adminlte-card title="Stores Data" icon="fas fa-lg fa-user-tie" collapsible maximizable>
        <a href="stores/manage">
            <button class="btn btn-xs btn-primary mb-3 w-100" title="Add Data">
                <i class="fa fa-lg fa-fw fa-plus"></i> Add
            </button>
        </a>
        <x-adminlte-datatable id="table_user" :heads="$heads" :config="$config" head-theme="dark" bordered hoverable
            compressed beautify />
    </x-adminlte-card>

@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>
        // console.log("Hi, I'm using the Laravel-AdminLTE package!");
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                $('.auto-close-alert').alert('close');
            }, 5000);
        });
    </script>
@endpush
