@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gestion de roles</h1>
@stop

@section('content')
    <table class="table table-dark table-striped">
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Correo Electronico</th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario -> idUsuario}}</td>
                    <td>{{$usuario -> nombre}}</td>
                    <td>{{$usuario -> telefono}}</td>
                    <td>{{$usuario -> direccion}}</td>
                    <td>{{$usuario -> correo}}</td>
                    @if ($usuario->idUsuario > 1 && $usuario->nombre != 'Administrador')
                        <td>
                            <a class="btn btn-dark" href="{{route('usuarios.edit', $usuario -> idUsuario)}}">Editar</a><!--indica que vamos al metodo edit ubicado en el controlador de usuarios y le enviamos el id-->
                        </td>
                        <td>
                            <form action="{{route('usuarios.destroy', $usuario->idUsuario)}}" method="POST">
                                @csrf

                                <button class="btn btn-outline-danger" type="submit">Dar de alta</button>
                            </form>

                        </td>
                        <td>
                            <form action="{{route('admin.users.store', $usuario->idUsuario)}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$usuario->idUsuario}}" name="idRoleUsu">
                                <button class="btn btn-outline-info" type="submit">Quitar rol de supervisor</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
