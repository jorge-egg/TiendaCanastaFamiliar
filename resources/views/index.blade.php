@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@stop
@section('fotoPerfil')
    <img src="img/perfil/{{$nameImg}}" alt="" width="40" height="40" border-radius="50%">
@stop
@section('content')
<div class="cont-general">
    @foreach ($productos as $producto)
        @if ($producto->disponibilidad > 0)
            <div class="contenedor">
                <div class="contenedor-img">
                    <img class="img-producto" src="img/productos/{{$producto->img}}" alt="">
                </div>
                <h6>{{$producto->nombre}}</h6>
                <p>${{$producto->precio}}</p>
                <div class="middle">
                    <form action="{{route('agregar',$producto->idProducto)}}" method="POST" >
                        @csrf
                        <input type="hidden" value="{{$id}}" name="usuario">
                        <input type="hidden" value="{{$producto->idProducto}}" name="producto">
                        <input type="hidden" value="{{$producto->precio}}" name="precio">
                        <button class="btn-agregar">agregar</button>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
</div>
@endsection
