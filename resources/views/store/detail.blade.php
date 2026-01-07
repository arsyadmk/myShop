@extends('admin.layout.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Client Detail')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Client')
@section('plugins.Datatables', true)

{{-- Content body: main page content --}}

@section('content_body')

    {{-- {{ dd((int) $client->id) }} --}}
    {{-- {{ dd($users) }} --}}
    @php
        // dd($users);
        $heads = [
            '',
            'Name',
            'Email',
            'Username',
            'User Type',
            'Client',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $btnEdit = '';
        $btnDelete = '';

        $user_temp = [];
        foreach ($users as $key => $user) {
            $btnEdit =
                '<a href="' .
                route('user.manage', $user->id) .
                '"><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></button></a>';
            $btnDelete =
                '<a href="' .
                route('user.delete', $user->id) .
                '" onclick="return confirm(\'Are you sure you want to delete this user?\')"><button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"><i class="fa fa-lg fa-fw fa-trash"></i></button></a>';
            $client_name_temp = '';
            if ($user->client) {
                $client_name_temp = $user->client->name;
            }
            $user_temp[] = [
                $key + 1,
                $user->name,
                $user->email,
                $user->username,
                jenis_user($user->jenis),
                $client_name_temp,
                '<nobr>' . $btnEdit . $btnDelete . '</nobr>',
            ];
        }
        $config = [
            'data' => $user_temp,
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, ['orderable' => false]],
        ];
        // dd($config_bu['data'], $config['data']);
    @endphp

    {{-- Themes --}}
    <x-adminlte-card title="Client ({{ $client->name }}) Detail" icon="fas fa-lg fa-user-tie" collapsible maximizable>
        <table class="table">
            <tbody>
                <tr>
                    <td>name</td>
                    <td>{{ $client->name }}</td>
                </tr>
                <tr>
                    <td>address</td>
                    <td>{{ $client->address }}</td>
                </tr>
                <tr>
                    <td>telephone</td>
                    <td>{{ $client->telephone }}</td>
                </tr>
                <tr>
                    <td>created_at</td>
                    <td>{{ $client->created_at->diffForHumans() }}</td>
                </tr>
                <tr>
                    <td>update_at</td>
                    <td>{{ optional($client->update_at)->diffForHumans() ?? 'No date available' }}</td>
                </tr>
            </tbody>
        </table>
    </x-adminlte-card>
    <x-adminlte-card title="Client ({{ $client->name }}) List Users" icon="fas fa-lg fa-user" collapsible maximizable>
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
    </script>
@endpush
