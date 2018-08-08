@extends('layouts.app')

@section('content')

<div class="background">
    <h1 class="title">{{$title}} #{{$company->id}}</h1>
</div>
<p><b>Nombre:</b> {{$company->name}}</p>
<p><b>Actividad:</b> {{$company->activity}}</p>
<p><b>Direccion:</b> {{$company->address}}</p>
<p><b>Seo:</b> {{$company->seo}}</p>
<p><b>Imagen:</b> <img src="{{url("$company->image")}}"></p>

<p class="return_index">
    <a class="btn btn-info" href="{{url('/compañias')}}">Regresar al listado</a>
</p>

@endsection