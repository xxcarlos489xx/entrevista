@extends('layouts.app')

@section('titulo', 'Agregar')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/tipo_cambio/app.css') }}">
@endpush

@section('content')
<div id="app">
    <add-cambio></add-cambio>
</div>
@endsection


@push('scripts')
    <script src="{{asset('assets/admin/js/tipo_cambio/add.js')}}"></script>
@endpush