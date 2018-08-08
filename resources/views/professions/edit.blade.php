@extends('layouts.app')

@section('content')
<div class="background">
    <h1 class="title">Editar profesion #{{$profession->id}}</h1>
</div>

@if($errors->any())<!--Si tenemos algun error-->
<div class="alert alert-danger">
    <h5>Porfavor corrige los errores</h5>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{url('profesiones')}}/{{$profession->id}}">
{{ method_field('PUT') }}
{{ csrf_field() }}<!--Protección de ataques laravel(token)-->
    <div class="form-group">
        <label for="title">titulo</label>
        <input type="text" class="form-control" id="title" name="title" 
        value="{{old('title',$profession->title)}}" 
        aria-describedby="titleHelp" placeholder="Enter title">
    </div>  
    {{--@if($errors->has('title'))
        <p>{{$errors->first('title')}}</p>
    @endif--}}  

    <div class="form-group">
        <label for="description">Descripción</label>
        <input type="text" class="form-control" id="description" name="description" 
        value="{{old('description',$profession->description)}}" 
        aria-describedby="descriptionHelp" placeholder="Enter description">
    </div>     
    @if (Auth::user())<!--Si el usuario está logueado-->
    <button type="submit" class="btn btn-primary">Actualizar Profesion</button>
    @else
    <div class="alert alert-danger">
        Para editar una profesion porfavor inicia sesión...
    </div>     
    <button disabled type="submit" class="btn btn-primary">Actualizar Profesion</button>
    @endif
    <a class="btn btn-info" href="{{url('/profesiones')}}">Regresar al listado</a>
</form>

@endsection