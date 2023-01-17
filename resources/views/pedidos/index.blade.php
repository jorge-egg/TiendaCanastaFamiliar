@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pedidos</h1>
@stop

@section('content')
<table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Cliente</th>
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Correo Electronico</th>
        <th>Productos</th>
        <th>Estado</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($productsCart as $productCart)
            @if ($productCart->estado == false)
                <tr>
                    <td>{{$productCart->idPedido}}</td>
                    <td>{{$productCart->nombre}}</td>
                    <td>{{$productCart->telefono}}</td>
                    <td>{{$productCart->direccion}}</td>
                    <td>{{$productCart->correo}}</td>
                    <td><form action="{{route('pendientesDetalle', $productCart->idPedido)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark">Ver</button>
                    </form></td>

                    <td>Pendiente</td>
                    <td><form action="{{route('pendientes.update', $productCart->idPedido)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-dark">Despachar</button>
                    </form></td>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
  </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
