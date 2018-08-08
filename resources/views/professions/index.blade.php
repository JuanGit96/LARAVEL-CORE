@extends('layouts.app')

@section('content')
@if (Auth::user())<!--Si el usuario está logueado-->
@else
<div class="alert alert-danger">
    Para eliminar un registro porfavor inicia sesión...
</div>  
@endif

<p>
    <a href="{{ route('professions.new') }}" class="btn btn-primary">Nueva Profesion</a>
</p>


<table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Titulo</th>
        <th scope="col">Descripción</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
<!--Mostrando usuarios-->
@forelse($professions as $profession)
    <tbody>
        <tr>
        <th scope="row"> {{$profession->id}}</th>
        <td> {{$profession->title}}</td>
        <td> {{$profession->description}}</td>
        <td class="action">
            <form method="POST" action="{{route('professions.delete',$profession->id)}}">
            {{ csrf_field() }}<!--Protección de ataques laravel(token)-->
            {{ method_field('DELETE') }}
            <a class="btn btn-link" href="{{route("professions.index")}}/{{$profession->id}}"><span class="oi oi-eye"></span></a>
            <a class="btn btn-link" href="{{route('professions.edit', $profession->id)}}"><span class="oi oi-pencil"></span></a>            
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
{!! $professions->links('vendor.pagination.bootstrap-4') !!}
</div>
@endsection