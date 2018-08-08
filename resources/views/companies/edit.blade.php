@extends('layouts.app')

@section('content')
<div class="background">
    <h1 class="title">Editar compañia #{{$company->id}}</h1>
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
<form method="POST" action="{{url('compañias')}}/{{$company->id}}">
{{ method_field('PUT') }}
{{ csrf_field() }}<!--Protección de ataques laravel(token)-->
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" 
        value="{{old('name',$company->name)}}" 
        aria-describedby="nameHelp" placeholder="">
    </div>  
    {{--@if($errors->has('name'))
        <p>{{$errors->first('name')}}</p>
    @endif--}}  

    <div class="form-group">
        <label for="activity">Actividad</label>
        <input type="text" class="form-control" id="activity" name="activity" 
        value="{{old('activity',$company->activity)}}" 
        aria-describedby="activityHelp" placeholder="">
    </div>  

    <div class="form-group">

        <label for="address">Direccion</label>
        <input autocomplete="on" type="text" class="form-control" id="address" name="address" value="{{old('address',$company->address)}}" 
        aria-describedby="addressHelp" placeholder="Selecciona en el mapa (Recomendado)">
        <div id="map" 
        style="width:100%; 
        height: 300px;">
        </div>

        <input type="hidden" name="latitud" id="latitud" title="latitud" value="">
        <input type="hidden" name="longitud" id="longitud" title="longitud" value="">


    </div>

    <div class="form-group">
        <label for="seo">SEO</label>
        <input type="text" class="form-control" id="seo" name="seo" 
        value="{{old('seo',$company->seo)}}" 
        aria-describedby="seoHelp" placeholder="">
    </div>

    <div class="form-group">
        <label for="image">Foto</label>
        <input type="text" class="form-control" id="image" name="image" 
        value="{{old('image',$company->image)}}" 
        aria-describedby="imageHelp" placeholder="url http://...">
    </div>   
    @if (Auth::user())<!--Si el usuario está logueado-->
    <button type="submit" class="btn btn-primary">Actualizar Compañia</button>
    @else
    <div class="alert alert-danger">
        Para actualizar una compañia porfavor inicia sesión...
    </div>         
    <button disabled type="submit" class="btn btn-primary">Actualizar Compañia</button>
    @endif
    <a class="btn btn-info" href="{{url('/compañias')}}">Regresar al listado</a>
</form>

@endsection

<script src="http://maps.googleapis.com/maps/api/js"></script> 

<script src="{{asset('js/map.js')}}"></script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA70fslcm8mwK6ZSGPOc_S0SNaAn74G_6Y&callback=initMap&libraries=places">
</script>