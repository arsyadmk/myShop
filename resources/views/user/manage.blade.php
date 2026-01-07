@extends('layout')

{{-- Customize layout sections --}}

@section('subtitle', 'User Manage')
@section('content_header_title', 'User Manage')

{{-- Content body: main page content --}}

@section('content_body')

    {{-- {{ dd((int) $user->id) }} --}}
    @php
        $jenisOptions = [
            1 => 'Admin',
            2 => 'Cashier',
        ];

        $selectedJenis = [old('role', $user->role)];
        $selectedStoreId = [old('store_id', $user->store_id)];

        //dynamic Action
        $currentAction = "";
        if(empty($user->id)){
            $currentAction = route('user.store');
        } else {
            $currentAction = route('user.update');
        }
    @endphp

    {{-- Themes --}}
    <form action="{{ $currentAction }}" method="post">
        @csrf
        <x-adminlte-card title="Users Add / Edit" icon="fas fa-lg fa-user" collapsible maximizable>
            <input type="hidden" name="id" value="{{ $user->id }}">
            {{-- <x-adminlte-input name="id" type="hidden" value="{{ $user->id }}" /> --}}
            <x-adminlte-input name="name" label="Name" value="{{ old('name', $user->name) }}" />
            <x-adminlte-input name="email" label="Email (login)" type="email"
                value="{{ old('email', $user->email) }}" />
            @if ($user->id)
                <x-adminlte-input name="password" label="Password" type="password" value="">
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">
                            *Leave blank to keep the current password.
                        </span>
                    </x-slot>
                </x-adminlte-input>
            @else
                <x-adminlte-input name="password" label="Password" type="password" value="12345678" readonly>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">
                            *User password default (12345678).
                        </span>
                    </x-slot>
                </x-adminlte-input>
            @endif
            <x-adminlte-select name="role" label="User Type" enable-old-support>
                <x-adminlte-options :options="$jenisOptions" :selected="$selectedJenis" empty-option="--Select User Type--" />
            </x-adminlte-select>
            <x-adminlte-select name="store_id" label="Store" enable-old-support>
                <x-adminlte-options :options="json_decode($stores, true)" :selected="$selectedStoreId" empty-option="--Select Store--" />
            </x-adminlte-select>
            <x-slot name="footerSlot">
                <x-adminlte-button class="btn-flat w-100" type="submit" label="Submit" theme="success"
                    icon="fas fa-lg fa-save" />
            </x-slot>
        </x-adminlte-card>
    </form>

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
