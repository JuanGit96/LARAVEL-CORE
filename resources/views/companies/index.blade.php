@extends('layouts.app')

@section('content')
@if (Auth::user())<!--Si el usuario está logueado-->
@else
<div class="alert alert-danger">
    Para eliminar un registro porfavor inicia sesión...
</div>  
@endif

<p>
    <a href="{{ route('companies.new') }}" class="btn btn-primary">Nueva Compañia</a>
</p>

<table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Actividad</th>
        <th scope="col">Direccion</th>
        <th scope="col">SEO</th>
        <th scope="col">Foto</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
<!--Mostrando usuarios-->
@forelse($companies as $company)
    <tbody>
        <tr>
        <th scope="row"> {{$company->id}}</th>
        <td> {{$company->name}}</td>
        <td> {{$company->activity}}</td>
        <td> {{$company->address}}</td>
        <td> {{$company->seo}}</td>
        <td> <img src="{{url("$company->image")}}"></td>        
        <td class="action">
            <form method="POST" action="{{route('companies.delete',$company->id)}}">
            {{ csrf_field() }}<!--Protección de ataques laravel(token)-->
            {{ method_field('DELETE') }}
            <a class="btn btn-link" href="{{route("companies.index")}}/{{$company->id}}"><span class="oi oi-eye"></span></a>
            <a class="btn btn-link" href="{{route('companies.edit', $company->id)}}"><span class="oi oi-pencil"></span></a>            
            @if (Auth::user())<!--Si el usuario está logueado-->            
            <button class="btn btn-link" type="submit" name="delete"><span class="oi oi-trash"></span></button>            
            @else
            <button disabled class="btn btn-link" type="submit" name="delete"><span class="oi oi-trash"></span></button>                        
            @endif           
            </form>   
        </td>
        </tr>
    </tbody>
@empty   
    <h3 class="alert alert-danger">Noy Hay registros Aún</h3>  
@endforelse
</table>
<div class="center-block">
{!! $companies->links('vendor.pagination.bootstrap-4') !!}
</div>
@endsection