@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('alert'))
                        <div class="alert alert-success">
                            {{ session('alert') }}
                        </div>
                    @endif

                    ¡Estás logueado!

                    <p>
                      Ahora puedes:
                      <ul>
                        <li>Acceder a el modulo de Empleados, compañias y profesiones</li>
                        <li>Hacer cambios en la base de datos por medio de dichos modulos</li>
                      </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
