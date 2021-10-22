@extends('layouts.app')

@section('titulo', 'Tipo Cambio')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/tipo_cambio/app.css') }}">
@endpush

@section('content')
<div id="app">
    <lista-cambio :rol="{{$rol}}"></lista-cambio>    
</div>
@endsection


@push('scripts')
    <script src="{{asset('assets/admin/js/tipo_cambio/index.js')}}"></script>
@endpush