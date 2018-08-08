@extends('layouts.app')

@section('content')

<div class="background">
    <h1 class="title">Nuevo Empleado</h1>
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
<form method="POST" action="{{url('empleados')}}">
{{ csrf_field() }}<!--Protección de ataques laravel(token)-->
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" 
        aria-describedby="nameHelp" placeholder="">
    </div>  
    {{--@if($errors->has('name'))
        <p>{{$errors->first('name')}}</p>
    @endif--}}      
    <div class="form-group">
        <label for="email">Correo electronico</label>
        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"
        aria-describedby="emailHelp" placeholder="ejemplo@correo.com">
    </div>

    <div class="form-group">
        <label for="profession">Profesión</label>
        <select class="form-control" id="profession_id" name="profession_id">  
        <option value="0" selected="true">sin profesion</option>
        @foreach($professions as $key => $profession)      
        <option value={{$key+1}}>{{$profession->title}}</option>  
        @endforeach
        </select>
    </div> 

    <div class="form-group">
        <label for="profession">Compañia</label>
        <select class="form-control" id="company_id" name="company_id">  
        <option value="0" selected="true">sin compañia</option>
        @foreach($companies as $key => $company)      
        <option value={{$key+1}}>{{$company->name}}</option>  
        @endforeach
        </select>
    </div>     

    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="">
    </div>
    @if (Auth::user())<!--Si el usuario está logueado-->
    <button type="submit" class="btn btn-primary">Crear Empleado</button>
    @else
    <div class="alert alert-danger">
        Para crear un nuevo empleado porfavor inicia sesión...
    </div>     
    <button disabled type="submit" class="btn btn-primary">Crear Empleado</button>  
    @endif  
    <a class="btn btn-info" href="{{url('/empleados')}}">Regresar al listado</a>
</form>

@endsection