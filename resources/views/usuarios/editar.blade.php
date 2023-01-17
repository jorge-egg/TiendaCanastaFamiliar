@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar</h1>
@stop

@section('content')
<form action="{{route('usuarios.update', $user->idUsuario)}}" method="POST" enctype="multipart/form-data"><!--formulario para la edicion de los registro ya existentes del usuario-->
    @csrf
    @method('PUT')
    <div class="mb-3"><!--campo de ingreso de nombre-->
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" id="nombre" value="{{$user->nombre}}">
    </div>
    <div class="mb-3"><!--campo de ingreso de telefono-->
        <label for="telefono" class="form-label">Telefono</label>
        <input type="text" name="telefono" class="form-control" id="telefono" value="{{$user->telefono}}">
    </div>
    <div class="mb-3"><!--campo de ingreso de direccion-->
        <label for="direccion" class="form-label">Direccion</label>
        <input type="text" name="direccion" class="form-control" id="direccion" value="{{$user->direccion}}">
    </div>
    <div class="mb-3"><!--campo de ingreso de correo electronico-->
      <label for="email" class="form-label">Correo electronico</label>
      <input type="email" name="correo" class="form-control" id="email" aria-describedby="emailHelp" value="{{$user->correo}}">
    </div>
    <div class="mb-3"><!--campo de ingreso de correo electronico-->
        <label for="img" class="form-label">Imagen de perfil</label>
        <input type="file" name="imgPerfil" id="img" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
      </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
