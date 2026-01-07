@extends('layout')

{{-- Customize layout sections --}}

@section('subtitle', 'User')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'User')
@section('plugins.Datatables', true)

{{-- Content body: main page content --}}

@section('content_body')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
    {{-- {{ dd($data_user) }} --}}
    {{-- <a href="{{ route('login.logout') }}">logout</a> --}}


@stop

@push('css')
@endpush

@push('js')
@endpush
