@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Nombre</th>
        <th>Referencia</th>
        <th>Precio</th>
        <th>Disponibilidad</th>
        <th>Imagen</th>
        <th></th>
    </thead>
    <tbody>
    @foreach ($productos as $producto)
        <tr>
            <td>{{$producto->idProducto}}</td>
            <td>{{$producto->nombre}}</td>
            <td>{{$producto->referencia}}</td>
            <td>${{$producto->precio}}</td>
            <td>{{$producto->disponibilidad}}</td>
            <td><img src="img/productos/{{$producto->img}}" alt="" width="100"></td>

            <td><a class="btn btn-dark" href="{{route('producto.edit', $producto->idProducto)}}">Editar</a><!--indica que vamos al metodo edit ubicado en el controlador de usuarios y le enviamos el id-->
            </td>

            <td>
                <form action="{{route('producto.destroy', $producto->idProducto)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>

    @endforeach


    </tbody>
  </table>
  <a class="btn btn-dark" href="{{route('producto.create')}}">Crear</a><!--indica que vamos al metodo edit ubicado en el controlador de usuarios y le enviamos el id-->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
