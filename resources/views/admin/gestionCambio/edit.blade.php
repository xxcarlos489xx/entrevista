@extends('layouts.app')

@section('titulo', 'Editar')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/tipo_cambio/app.css') }}">
@endpush

@section('content')
<div id="app">
    <edit-cambio :tc="{{$tc}}"></edit-cambio>
</div>
@endsection


@push('scripts')
    <script src="{{asset('assets/admin/js/tipo_cambio/edit.js')}}"></script>
@endpush