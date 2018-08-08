@extends('layouts.app')

@section('content')

<div class="background">
    <h1 class="title">{{$title}} #{{$employee->id}}</h1>
</div>
<p><b>Nombre del Empleado:</b> {{$employee->name}}</p>
<p><b>e-mail del Empleado:</b> {{$employee->email}}</p>
@if($employee->profession['title'] == null)
<p><b>Profesion del Empleado:</b> sin profesion</p>
@else
<p><b>Profesion del Empleado:</b> {{$employee->profession['title']}}</p>
@endif
@if($employee->company['name'] == null)
<p><b>Compañia del usuario:</b> sin compañia</p>
@else
<p><b>Compañia del Empleado:</b> {{$employee->company['name']}}</p>
@endif

<p class="return_index">
    <a class="btn btn-info" href="{{url('/empleados')}}">Regresar al listado</a>
</p>

@endsection