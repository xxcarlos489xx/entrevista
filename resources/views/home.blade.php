@extends('layouts.app')

@section('titulo', 'Bienvenido')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bienvenido!</div>
                <div class="card-body">
                    <label>Has iniciado sesión con el rol de {{ $rol }}</label>
                    <section>
                        <div class="row m-3 mt-5 welcome">
                            <div class="col-12 col-lg-3 col-md-6 col-sm-6 d-flex flex-column align-items-center box-module">
                                <a href="{{ route('TipoCambio') }}"><i class="fas fa-hand-holding-usd my-3"></i></a>
                                <small>
                                    {{$rol == 'Admin' ? 'Administrar' : 'Listar'}} tipos <br>de cambios
                                </small>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
