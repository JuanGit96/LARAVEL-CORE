@extends('layouts.app')

@section('content')
@if (Auth::user())<!--Si el usuario está logueado-->
@else
<div class="alert alert-danger">
    Para eliminar un registro porfavor inicia sesión...
</div>  
@endif

<p>
    <a href="{{ route('employees.new') }}" class="btn btn-primary">Nuevo Empleado</a>
</p>

<table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Profesión</th>
        <th scope="col">Compañia</th>
        <th scope="col">Correo</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
<!--Mostrando usuarios-->
@forelse($employees as $employee)
    <tbody>
        <tr>
        <th scope="row"> {{$employee->id}}</th>
        <td> {{$employee->name}}</td>
        @if($employee->profession['title'])
        <td> {{$employee->profession['title']}}</td>
        @else
        <td>sin profesion</td>
        @endif
        @if($employee->company['name'])
        <td> {{$employee->company['name']}}</td>
        @else
        <td>sin compañia</td>
        @endif        
        <td>{{$employee->email}}</td>
        <td class="action">
            <form method="POST" action="{{route('employees.delete',$employee->id)}}">
            {{ csrf_field() }}<!--Protección de ataques laravel(token)-->
            {{ method_field('DELETE') }}
            <a class="btn btn-link" href="{{route("employees.index")}}/{{$employee->id}}"><span class="oi oi-eye"></span></a>
            <a class="btn btn-link" href="{{route('employees.edit', $employee->id)}}"><span class="oi oi-pencil"></span></a>            
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
{{--Paginación--}}
<div class="center-block">
{!! $employees->links('vendor.pagination.bootstrap-4') !!}
</div>
@endsection