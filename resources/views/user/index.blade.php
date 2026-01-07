@extends('layout')

{{-- Customize layout sections --}}

@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('plugins.Datatables', true)

{{-- Content body: main page content --}}

@section('content_body')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
    {{-- {{ dd($data_user) }} --}}
    {{-- <a href="{{ route('login.logout') }}">logout</a> --}}

    @if (session('success'))
        <x-adminlte-alert class="auto-close-alert" theme="success" title="Success" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    {{-- Setup data for datatables --}}
    @php
        // dd($users);
        $heads = [
            '',
            'Name',
            'Email',
            'User Type',
            'Client',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $btnEdit = '';
        $btnDelete = '';

        $user_temp = [];
        foreach ($users as $key => $user) {
            // dd($user);

            if ($user->role == 0) {
                $btnDelete = '';
                $btnEdit = '';
            } else {
                $btnEdit =
                    '<a href="users/manage/' .
                    $user->id .
                    '"><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></button></a>';
                $btnDelete =
                    '<a href="users/manage/delete/' .
                    $user->id .
                    '" onclick="return confirm(\'Are you sure you want to delete this user?\')">
        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
            <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>
    </a>';
            }
            $store_name_temp = '';
            if ($user->store) {
                $store_name_temp = $user->store->name;
            }
            $user_temp[] = [
                $key + 1,
                $user->name,
                $user->email,
                jenis_user($user->role),
                $store_name_temp,
                '<nobr>' . $btnEdit . $btnDelete . '</nobr>',
            ];
        }
        $config = [
            'data' => $user_temp,
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false]],
        ];
        // dd($config_bu['data'], $config['data']);

        function jenis_user($value)
        {
            if ($value == 0) {
                return 'Super Admin';
            } elseif ($value == 1) {
                return 'Admin';
            } elseif ($value == 2) {
                return 'Cashier';
            }
        }
    @endphp

    {{-- Themes --}}
    <x-adminlte-card title="Users Data" icon="fas fa-lg fa-user" collapsible maximizable>
        {{-- <p>{{ jenis_user(1) }}</p> --}}
        <a href="users/manage">
            <button class="btn btn-xs btn-primary mb-3 w-100" title="Add Data">
                <i class="fa fa-lg fa-fw fa-plus"></i> Add
            </button>
        </a>
        <x-adminlte-datatable id="table_user" :heads="$heads" :config="$config" head-theme="dark" bordered hoverable
            compressed beautify />

        {{-- Minimal example / fill data using the component slot --}}
        {{-- <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" bordered hoverable compressed beautify>
            @foreach ($config_bu['data'] as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </x-adminlte-datatable> --}}

        {{-- Compressed with style options / fill data using the plugin config --}}
        {{-- <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config" striped hoverable bordered compressed /> --}}
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
