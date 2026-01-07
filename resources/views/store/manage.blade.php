@extends('layout')

{{-- Customize layout sections --}}

@section('subtitle', 'Store Manage')
@section('content_header_title', 'Store Manage')

{{-- Content body: main page content --}}

@section('content_body')

    @php

        //dynamic Action
        $currentAction = '';
        if (empty($store->id)) {
            $currentAction = route('store.store');
        } else {
            $currentAction = route('store.update');
        }
        
        $storeTypeOptions = [
            0 => 'Pusat',
            1 => 'Cabang',
            2 => 'Retail',
        ];

        $selectedStoreType = [old('type', $store->type)];
    @endphp

    {{-- Themes --}}
    <form action="{{ $currentAction }}" method="post">
        @csrf
        <x-adminlte-card title="Store Add / Edit" icon="fas fa-lg fa-user-tie" collapsible maximizable>
            <input type="hidden" name="id" value="{{ $store->id }}">
            <x-adminlte-input name="name" label="Name" value="{{ old('name', $store->name) }}" />
            <x-adminlte-select name="type" label="Store Type" enable-old-support>
                <x-adminlte-options :options="$storeTypeOptions" :selected="$selectedStoreType" empty-option="--Select User Type--" />
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
