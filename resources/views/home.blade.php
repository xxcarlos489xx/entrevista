@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bienvenido</div>
                <div class="card-body">
                    <label>Has iniciado sesión con el rol de {{ Auth::user() }}</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
