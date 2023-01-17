@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar</h1>
@stop

@section('content')
<form action="{{route('producto.update', $producto->idProducto)}}" method="POST" enctype="multipart/form-data"><!--formulario para la edicion de los registro ya existentes del usuario-->
    @csrf
    @method('PUT')
    <div class="mb-3"><!--campo de ingreso de nombre-->
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" id="nombre" value="{{$producto->nombre}}">
    </div>
    <div class="mb-3"><!--campo de ingreso de nombre-->
        <label for="referencia" class="form-label">Referencia</label>
        <input type="text" name="referencia" class="form-control" id="referencia" value="{{$producto->referencia}}">
    </div>
    <div class="mb-3"><!--campo de ingreso de precio-->
        <label for="precio" class="form-label">Precio</label>
        <input type="text" name="precio" class="form-control" id="precio" value="{{$producto->precio}}">
    </div>
    <div class="mb-3"><!--campo de ingreso de disponibilidad-->
        <label for="disponibilidad" class="form-label">Disponibilidad</label>
        <input type="text" name="disponibilidad" class="form-control" id="disponibilidad" value="{{$producto->disponibilidad}}">
    </div>
    <input type="file" class="form-control" name="imagenProducto" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

    <button type="submit" class="btn btn-primary">Actualizar</button>
  </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
