@extends('layouts.app')

@section('content')

<div class="background">
    <h1 class="title">{{$title}} #{{$profession->id}}</h1>
</div>
<p><b>Nombre del titulo:</b> {{$profession->title}}</p>
<p><b>Descripcion del titulo:</b> {{$profession->description}}</p>

<p class="return_index">
    <a class="btn btn-info" href="{{url('/profesiones')}}">Regresar al listado</a>
</p>

@endsection